<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function loginForm()
    {
        return view('client.auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);
        $check=$request->all();
        $data=['email'=>$check['email'],'password'=>$check['password']];
        if(Auth::guard('client')->attempt($data)){
            return redirect(route('client.dashboard'))->with('success','Login Successfully');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    } 
    public function clientRegister()
    {
        return view('client.auth.register');
    }
    public function clientRegisterCreate(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|max:255|unique:clients',
            'password'=> 'required|min:8|confirmed',
            'address'=>'max:500',
            // 'phone'=>'numeric',

            
        ]);
        Client::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'phone'=>$request->phone,
            'address'=>$request->address,
            'role'=>'client',
            'status'=>0,

        ]);
        $notification=array(
            'message'=>'Client Register Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('client.login')->with($notification);
    } 
    public function dashboard()
    {
        return view('client.dashboard');
    } 
    public function logout()
    {
        Auth::guard('client')->logout();
        $notification=array(
            'message'=>'Logout Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('client.login')->with($notification);
    } 

    public function profile()
    {
        $id=Auth::guard('client')->id();
        $profileData=Client::find($id);
        $cities=City::where('status', 1)->get();
        return view('client.profile.index', compact('profileData', 'cities'));
    } 
    public function profileUpdate(Request $request)
    {
        // dd($request->all());
        $id=Auth::guard('client')->id();
		$data=Client::find($id);
		$data->name=$request->name;
		$data->email=$request->email;
		$data->phone=$request->phone;
		$data->address=$request->address;
        $data->city_id=$request->city_id;
        $data->shop_info=$request->shop_info;
		$oldImagePath=$data->image;
        $oldCoverPath=$data->cover_image;
		if ($request->hasFile('image')){
			$file=$request->file('image');
			$fileName=time().'.'.$file->getClientOriginalExtension();
			$file->move(public_path('uploads/client_profile'),$fileName);
			$data->image=$fileName;
			if ($oldImagePath && $oldImagePath !== $fileName){
				$this->deleteOldImage($oldImagePath);
			}
		}
		if ($request->hasFile('cover_image')){
			$cover=$request->file('cover_image');
			$cover_image_name=time().'.'.$cover->getClientOriginalExtension();
			$cover->move(public_path('uploads/client_profile'),$cover_image_name);
			$data->cover_image=$cover_image_name;
            if ($oldCoverPath && $oldCoverPath !== $cover_image_name){
				$this->deleteOldImage($oldCoverPath);
			}
		}
		$data->save();
        $notification=array(
            'message'=>'Profile Updated Successfully',
            'alert-type'=>'success'
        );
		return redirect()->back()->with($notification);
    } 
    private function deleteOldImage(string $oldImagePath): void {
		$fullPath=public_path('uploads/client_profile/'.$oldImagePath);
		if (file_exists($fullPath)){
			unlink($fullPath);
		}
	}
    public function passwordChange()
    {
        $id=Auth::guard('client')->id();
        $profile=Client::find($id);
        return view('client.profile.password-change', compact('profile'));
        
    } 
    public function passwordUpdate(Request $request)
    {
        $client=Auth::guard('client')->user();
        $request->validate([
            'old_password'=> 'required',
            'new_password'=> 'required|min:8|confirmed',
        ]);

        if(!Hash::check($request->old_password, $client->password)){
            $notification=array(
                'message'=>'Old Password not match',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        
        //client password update:

        Client::where('id', $client->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        $notification=array(
            'message'=>'Password Changed Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    } 
}

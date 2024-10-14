<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.index');
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $id=Auth::user()->id;
		$data=User::find($id);
		$data->name=$request->name;
		$data->email=$request->email;
		$data->phone=$request->phone;
		$data->address=$request->address;
		$oldImagePath=$data->image;
		if ($request->hasFile('image')){
			$file=$request->file('image');
			$fileName=time().'.'.$file->getClientOriginalExtension();
			$file->move(public_path('uploads/user_profile'),$fileName);
			$data->image=$fileName;
			if ($oldImagePath && $oldImagePath !== $fileName){
				$this->deleteOldImage($oldImagePath);
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
		$fullPath=public_path('uploads/user_profile/'.$oldImagePath);
		if (file_exists($fullPath)){
			unlink($fullPath);
		}
	}
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification=array(
            'message'=>'Logout Successfully',
            'alert-type'=>'success'
        );

        return redirect('/')->with($notification);
    } 
    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $user=Auth::guard('web')->user();
        $request->validate([
            'old_password'=> 'required',
            'new_password'=> 'required|min:8|confirmed',
        ]);

        if(!Hash::check($request->old_password, $user->password)){
            $notification=array(
                'message'=>'Old Password not match',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        
        //user password update:

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        $notification=array(
            'message'=>'Password Changed Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification)->withFragment('change-password');

    } 
    public function changePassword()
    {
        return view('frontend.dashboard.section.change-password');
    }
}

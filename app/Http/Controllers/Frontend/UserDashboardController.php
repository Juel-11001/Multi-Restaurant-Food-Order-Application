<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

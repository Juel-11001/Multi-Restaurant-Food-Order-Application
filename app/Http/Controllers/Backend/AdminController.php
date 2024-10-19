<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function adminLogin()
    {
        return view('admin.auth.login');
    }
    public function adminLoginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $check = $request->all();
        $data = ['email' => $check['email'], 'password' => $check['password']];
        if (Auth::guard('admin')->attempt($data)) {
            return redirect(route('admin.dashboard'))->with('success', 'Login Successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout Successfully');
    }
    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }
    public function forgotPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $admin_data = Admin::where('email', $request->email)->first();
        if (!$admin_data) {
            return redirect()->back()->with('error', 'Email not found');
        }
        $token = hash('sha256', time());
        $admin_data->update(['token' => $token]);
        $reset_link = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = "Click on the below link to reset your password";
        $message .= "<a href='" . $reset_link . "'> Click Here</a>";
        Mail::to($request->email)->send(new WebsiteMail($subject, $message));
        return redirect()->back()->with('success', 'Reset link sent to your email');
    }
    public function resetPassword($token, $email)
    {
        $admin_data = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin_data) {
            return redirect()->route('admin.login')->with('error', 'Invalid Token');
        }
        return view('admin.auth.reset-password', compact('token', 'email'));
    }
    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
        $admin_data = Admin::where('email', $request->email)->where('token', $request->token)->first();
        if (!$admin_data) {
            return redirect()->route('admin.login')->with('error', 'Invalid Token');
        }
        $admin_data->password = bcrypt($request->password);
        $admin_data->token = '';
        $admin_data->save();
        return redirect()->route('admin.login')->with('success', 'Password Changed Successfully');
    }
    public function adminProfile()
    {
        $id = Auth::guard('admin')->id();
        $admin = Admin::find($id);
        return view('admin.profile.index', compact('admin'));
    }
    public function adminProfileUpdate(Request $request)
    {
        //		dd($request->all());
        $id = Auth::guard('admin')->id();
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $oldImagePath = $data->photo;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/admin_profile'), $fileName);
            $data->photo = $fileName;
            if ($oldImagePath && $oldImagePath !== $fileName) {
                $this->deleteOldImage($oldImagePath);
            }
        }
        $data->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    private function deleteOldImage(string $oldImagePath): void
    {
        $fullPath = public_path('uploads/admin_profile/' . $oldImagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
    public function adminPasswordChange()
    {
        $id = Auth::guard('admin')->id();
        $profile = Admin::find($id);
        return view('admin.profile.password-change', compact('profile'));
    }
    public function adminPasswordUpdate(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, $admin->password)) {
            $notification = array(
                'message' => 'Old Password not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        //admin password update:
        Admin::where('id', $admin->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

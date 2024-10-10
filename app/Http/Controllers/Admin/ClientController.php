<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function Dashboard()
    {
        return "<h1>Welcome to Client Dashboard</h1>";
    } 
}

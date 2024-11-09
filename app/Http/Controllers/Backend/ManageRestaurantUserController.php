<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ManageRestaurantUserController extends Controller
{
    public function index()
    {
        $users = Client::where('status', 1)->get();
        return view('admin.manage.restaurant-users.index', compact('users'));
    }
    public function pendingUsers()
    {
        $users=Client::where('status', 0)->get();
        return view('admin.manage.restaurant-users.user-pending', compact('users'));
    }
    public function changeStatus(Request $request)
    {
        $id=$request->id;
        // dd($id);
        $users=Client::where('id', $id)->findOrFail($id);
        $users->status=$request->status == 'true' ? 1 : 0 ;
        $users->save();
        session()->flash('statusMessage', 'Status has been updated!');
        return response()->json(['reload' => true]);
    }
}

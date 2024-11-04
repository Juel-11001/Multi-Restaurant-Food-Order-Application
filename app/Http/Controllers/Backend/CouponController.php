<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index(){
        $client_id=Auth::guard('client')->id();
        $coupons=Coupon::where('client_id', $client_id)->orderBy('id', 'desc')->get();
        return view('client.coupon.index', compact('coupons'));
    }
    public function create(){
        return view('client.coupon.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:250',
            'discount'=>'required',
            'validity'=>'required',
            'status'=>'required'
        ]);
        Coupon::create([
            'name'=>strtoupper($request->name),
            'validity'=>$request->validity,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'client_id'=>Auth::guard('client')->id(),
            'created_at'=>Carbon::now(),
        ]);

        $notification = [
            'message' => 'Coupon created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.coupon.index')->with($notification);
    }

    public function edit($id){
        $client_id=Auth::guard('client')->id();
        $coupon=Coupon::where('client_id', $client_id)->findOrFail($id);
        return view('client.coupon.edit', compact('coupon'));
    }

    public function update(Request $request){
        $coupon_id=$request->id;
        $request->validate([
            'name'=>'required|max:250',
            'discount'=>'required',
            'validity'=>'required',
            'status'=>'required'
        ]);
        
       Coupon::findOrFail($coupon_id)->update([
            'name'=>strtoupper($request->name),
            'validity'=>$request->validity,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'updated_at'=>Carbon::now(),
        ]);
        $notification = [
            'message' => 'Coupon updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.coupon.index')->with($notification);
    }
    public function destroy($id){
        Coupon::findOrFail($id)->delete();
        $notification = [
            'message' => 'Coupon deleted successfully',
            'alert-type' => 'success'
        ];
        return response(['status' => 'success','message' => 'Coupon Deleted Successfully']);
    }
    public function changeStatus(Request $request)
    {
        $client_id=Auth::guard('client')->id();
        $coupon=Coupon::where('client_id', $client_id)->findOrFail($request->id);
        $coupon->status=$request->status == 'true' ? 1 : 0 ;
        $coupon->save();

        return response(['message'=>'Status has been Updated!']);
    } 
}

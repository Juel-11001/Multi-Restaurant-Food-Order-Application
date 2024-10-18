<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::latest()->get();
        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name' => 'required|max:250',
            'status'=>'required',
        ]);
        City::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>$request->status
        ]);

        $notification = [
            'message' => 'City Created Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.city.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city=City::find($id);
        return response()->json($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city=City::find($id);
        // dd($city);
        $validate=$request->validate([
            'name' => 'max:250',
            'status'=>'required',
        ]);
        $city->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>$request->status
        ]);
        $notification = [
            'message' => 'City Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.city.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city=City::find($id);
        $city->delete();
        return response(['status' => 'success','message' => 'City Deleted Successfully']);
    }
    public function changeStatus(Request $request)
    {
        $city=City::findOrFail($request->id);
        $city->status=$request->status == 'true' ? 1 : 0 ;
        $city->save();

        return response(['message'=>'Status has been Updated!']);
    } 
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus=Menu::latest()->get();
        return view('client.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'status' => 'required',
        ]);
        $imagePath = $this->uploadImage($request, 'image', 'uploads/menu');
        Menu::create([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status
        ]);
        $notification=array(
            'message'=>'Category Created Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('client.menu.index')->with($notification);
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
        $menu=Menu::find($id);
        return view('client.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu=Menu::findOrFail($id);

        $validate=$request->validate([
            'name' => 'max:250',
            'image'=>'nullable|mimes:jpg,png,jpeg,svg,webp,gif|max:5120',
            'status'=>'required',
        ]);
        if ($request->file('image')) {
            $this->deleteImage($menu->image);
            $imagePath = $this->uploadImage($request, 'image', 'uploads/menu');
        } else {
            $imagePath = $menu->image;
        }
        $menu->update([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status
        ]);
        $notification = [
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.menu.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu=Menu::find($id);
        $this->deleteImage($menu->image);
        $menu->delete();
        return response(['status' => 'success','message' => 'Menu Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $menu=Menu::findOrFail($request->id);
        $menu->status=$request->status == 'true' ? 1 : 0 ;
        $menu->save();

        return response(['message'=>'Status has been Updated!']);
    } 
}

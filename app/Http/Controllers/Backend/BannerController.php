<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->orderBy('id', 'desc')->get();
        return view('admin.banner.index', compact('banners'));
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
        // dd($request->all());
        $request->validate([
            'url' => 'url',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);
        $imagePath = $this->uploadImage($request, 'image', 'uploads/banner', $width=400, $height=400);
        // dd($imagePath);
        Banner::create([
            'url' => $request->url,
            'status' => $request->status,
            'image' => $imagePath,
        ]);
        $notification = [
            'message' => 'Banner Created Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.manage-banner.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banners = Banner::where('id', $id)->find($id);
        return response()->json($banners);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'url' => 'url',
            'status' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $banner = Banner::where('id', $id)->findOrFail($id);

        if ($request->file('image')) {
            $this->deleteImage($banner->image);
            $imagePath = $this->uploadImage($request, 'image', 'uploads/banner', $width=400, $height=400);
        } else {
            $imagePath = $banner->image;
        }
        $banner->update([
            'url' => $request->url,
            'status' => $request->status,
            'image' => $imagePath,
        ]);
        $notification = [
            'message' => 'Banner Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.manage-banner.index')->with($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner=Banner::where('id', $id)->find($id);
        $this->deleteImage($banner->image);
        $banner->delete();
        return response(['status' => 'success','message' => 'Banner Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $banner=Banner::where('id', $request->id)->findOrFail($request->id);
        $banner->status=$request->status == 'true' ? 1 : 0 ;
        $banner->save();

        return response(['message'=>'Status has been Updated!']);
    } 
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImageGallery;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageGalleryController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imageGalleries = ImageGallery::latest()->get();
        return view('client.product.image-gallery.index', compact('imageGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.product.image-gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:5120',
        ]);
        $imagePath = $this->uploadMultiImage($request, 'images', 'uploads/image-gallery');
        foreach ($imagePath as $path) {
            ImageGallery::create([
                'client_id' => Auth::guard('client')->id(),
                'image' => $path
            ]);
        }
        $notification = [
            'message' => 'Image Gallery Created Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.gallery.index')->with($notification);
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
        $imageGallery = ImageGallery::findOrFail($id);
        return view('client.product.image-gallery.edit', compact('imageGallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|max:5120',
        ]);
        $imageGallery = ImageGallery::findOrFail($id);
        if ($request->file('image')) {
            $this->deleteImage($imageGallery->image);
            $imagePath = $this->uploadImage($request, 'image', 'uploads/image-gallery', 500,500);
        } else {
            $imagePath = $imageGallery->image;
        }
        $imageGallery->update([
            'image' => $imagePath
        ]);
        $notification = [
            'message' => 'Image Gallery Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.gallery.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imageGallery = ImageGallery::findOrFail($id);
        $this->deleteImage($imageGallery->image);
        $imageGallery->delete();
        return response(['status' => 'success','message' => 'Image Gallery Deleted Successfully']);
    }
}

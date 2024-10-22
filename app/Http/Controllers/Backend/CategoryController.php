<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Str;
class CategoryController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate=$request->validate([
            'name' => 'required|max:250',
            'image'=>'required|mimes:jpg,png,jpeg,svg,webp,gif|max:5120',
            'status'=>'required',
        ]);
        $imagePath = $this->uploadImage($request, 'image', 'uploads/category');
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath,
            'status' => $request->status
        ]);
        $notification=array(
            'message'=>'Category Created Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.category.index')->with($notification);
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
        $category=Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category=Category::findOrFail($id);

        $validate=$request->validate([
            'name' => 'max:250',
            'image'=>'nullable|mimes:jpg,png,jpeg,svg,webp,gif|max:5120',
            'status'=>'required',
        ]);
        if ($request->file('image')) {
            $this->deleteImage($category->image);
            $imagePath = $this->uploadImage($request, 'image', 'uploads/category');
        } else {
            $imagePath = $category->image;
        }
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath,
            'status' => $request->status
        ]);
        $notification = [
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $this->deleteImage($category->image);
        $category->delete();
        return response(['status' => 'success','message' => 'Category Deleted Successfully']);
    }
    public function changeStatus(Request $request){
        $category=Category::findOrFail($request->id);
        $category->status=$request->status == 'true' ? 1 : 0 ;
        $category->save();

        return response(['message'=>'Status has been Updated!']);
    }
    
}

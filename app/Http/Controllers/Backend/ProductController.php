<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Menu;
use App\Models\Product;
use App\Traits\imageUploadTrait;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductController extends BaseController
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::where('client_id', $this->user_id)->orderBy('id', 'desc')->latest()->get();
        return view('client.product.in', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get();
        $cities=City::get();
        $menus=Menu::get();
        return view('client.product.create', compact('categories', 'cities', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:250',
            'category_id'=>'required',
            'menu_id'=>'required',
            'city_id'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'status'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ],[
            'name.required' => 'Product Name is Required',
            'name.max' => 'Product Name Must Be Less Than 250 Characters',
            'category_id.required' => 'Category is Required',
            'menu_id.required' => 'Menu is Required',
            'city_id.required' => 'City is Required',
            'price.required' => 'Price is Required',
            'qty.required' => 'Quantity is Required',
            'status.required' => 'Status is Required',
            'image.required' => 'Please selecte an image',
            'image.max' => 'Image Size Must Be Less Than 5 MB',
        ]);
        $p_code=IdGenerator::generate(['table' => 'products', 'field'=>'code' ,'length' => 8, 'prefix' => 'js-']);
        $imagePath = $this->uploadImage($request, 'image', 'uploads/product');
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'client_id'=> Auth::guard('client')->id(),
            'qty' => $request->qty,
            'price' => $request->price,
            'code' => $p_code,
            'discount_price' => $request->discount_price,
            'size'=> $request->size,
            'category_id' => $request->category_id,
            'menu_id' => $request->menu_id,
            'city_id' => $request->city_id,
            'status' => $request->status,
            'product_type'=>$request->product_type,
            'image' => $imagePath
        ]);
        $notification = [
            'message' => 'Product Created Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.product.index')->with($notification);
        
        
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
        $product=Product::where('client_id', $this->user_id)->find($id);
        $menus=Menu::where('status', 1)->get();
        $cities=City::where('status', 1)->get();
        $categories=Category::where('status', 1)->get();
        return view('client.product.edi', compact('product', 'menus', 'cities', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:250',
            'category_id'=>'required',
            'menu_id'=>'required',
            'city_id'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'status'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ],[
            'name.required' => 'Product Name is Required',
            'name.max' => 'Product Name Must Be Less Than 250 Characters',
            'category_id.required' => 'Category is Required',
            'menu_id.required' => 'Menu is Required',
            'city_id.required' => 'City is Required',
            'price.required' => 'Price is Required',
            'qty.required' => 'Quantity is Required',
            'status.required' => 'Status is Required',
            'image.required' => 'Please selecte an image',
            'image.max' => 'Image Size Must Be Less Than 5 MB',
        ]);
        
        $product=Product::where('client_id', $this->user_id)->findOrFail($id);

        if ($request->file('image')) {
            $this->deleteImage($product->image);
            $imagePath = $this->uploadImage($request, 'image', 'uploads/product');
        } else {
            $imagePath = $product->image;
        }
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'qty' => $request->qty,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'size'=> $request->size,
            'category_id' => $request->category_id,
            'menu_id' => $request->menu_id,
            'city_id' => $request->city_id,
            'status' => $request->status,
            'product_type'=>$request->product_type,
            'image' => $imagePath
        ]);
        $notification = [
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('client.product.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::where('client_id', $this->user_id)->find($id);
        $this->deleteImage($product->image);
        $product->delete();
        return response(['status' => 'success','message' => 'Product Deleted Successfully']);
    }
    public function changeStatus(Request $request)
    {
        $product=Product::where('client_id', $this->user_id)->findOrFail($request->id);
        $product->status=$request->status == 'true' ? 1 : 0 ;
        $product->save();

        return response(['message'=>'Status has been Updated!']);
    } 
}

@extends('admin.layouts.master')
{{-- @section('title', 'Create New Product') --}}
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                                <li class="breadcrumb-item active">Create Product</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title m-0">Create Product</h4>
                            <a href="{{ route('admin.manage-product.index') }}"
                                class="btn btn-primary btn-rounded waves-effect waves-light">
                                <i class="mdi mdi-arrow-left-thin"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div>
                                    <form action="{{ route('admin.manage-product.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-firstname-input">Name</label>
                                                    <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter Product Name" name="name" value="{{ $product->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label for="example-number-input" class="form-label">Quantity</label>
                                                    <input class="form-control" type="number" value="{{ $product->qty }}" id="example-number-input" name="qty">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label for="example-number-input" class="form-label">Price</label>
                                                    <input class="form-control" type="number" value="{{ $product->price }}" id="example-number-input" name="price">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label for="example-number-input" class="form-label">Discount Price </label>
                                                    <input class="form-control" type="number" value="{{ $product->discount_price }}" id="example-number-input" name="discount_price">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label for="example-number-input" class="form-label">size </label>
                                                    <input class="form-control" type="text" value="{{ $product->size }}" id="example-number-input" name="size">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Client</label>
                                                    <select class="form-select" name="client_id">
                                                        <option value="">Select Client</option>
                                                        @foreach ($clients as $client)
                                                        <option {{ $product->client_id == $client->id ? 'selected' : ''}} value="{{ $client->id }}">{{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select" name="category_id">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                        <option {{ $product->category_id == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">City</label>
                                                    <select class="form-select" name="city_id">
                                                        <option value="">Select City</option>
                                                        @foreach ($cities as $city)
                                                        <option {{ $product->city_id == $city->id ? 'selected' : ''}} value="{{ $city->id }}">{{$city->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Menu</label>
                                                    <select class="form-select" name="menu_id">
                                                        <option value="">Select Menu</option>
                                                        @foreach ($menus as $menu)
                                                        <option {{ $product->menu_id == $menu->id ? 'selected' : ''}} value="{{ $menu->id }}">{{$menu->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-select" name="status">
                                                        <option {{$product->status==1 ? 'selected' : ''}} value="1">Active</option>
                                                        <option {{$product->status==0 ? 'selected' : ''}} value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Product Type</label>
                                                    <select class="form-select" name="product_type">
                                                        <option value="">Select Product Type</option>
                                                        <option {{$product->product_type=='most_popular' ? 'selected' : ''}} value="most_popular">Most Popular</option>
                                                        <option {{$product->product_type=='best_seller' ? 'selected' : ''}} value="best_seller">Best Seller</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="example-text-input" class="form-label">Image</label>
                                                <input class="form-control" name="image" type="file" value=""
                                                    id="image">
                                            </div>
                                            <div class="mb-3 col-md-6 ml-5">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xl me-3">
                                                        <img src="{{asset($product->image)}}" alt=""
                                                            class="rounded-circle p-1 bg-primary" id="showImage"
                                                            width="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary w-md">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })
        })
    </script>
@endpush


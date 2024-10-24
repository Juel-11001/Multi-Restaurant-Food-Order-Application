@extends('client.layouts.master')
@section('title', 'Products')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Product</h4>

                    <div class="page-title-right">
                        <a href="{{ route('client.gallery.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light float-end"> <i class="mdi mdi-plus"></i> Create New</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive w-100">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($imageGalleries as $gallery)    
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset($gallery->image)}}" alt="" width="70px" height="40px" ></td>
                                    <td>
                                        <a href="{{ route('client.gallery.edit', $gallery->id) }}" class="btn btn-primary"><i class="far fa-edit"></i>
                                        </a>
                                        <a href="{{ route('client.gallery.destroy', $gallery->id) }}" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> 
        </div> 
    </div>
</div>
@endsection
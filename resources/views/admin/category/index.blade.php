@extends('admin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Categories</h4>

                    <div class="page-title-right">
                        {{-- <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol> --}}
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light float-end"> <i class="mdi mdi-plus"></i> Create New</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header ">
                        <h5 class="card-title d-inline">All Categories</h5>
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light float-end"> <i class="mdi mdi-plus"></i> Add Category</a>
                    </div> --}}
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)    
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset($category->image)}}" alt="{{$category->name}}" width="80px" height="60px" ></td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @if ($category->status==1)
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$category->id}}" checked="{{$category->status}}">
                                            </div>
                                            <span class="badge bg-success"></span>
                                        @else
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$category->id}}">
                                        </div>
                                            <span class="badge bg-danger"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary"><i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.category.destroy', $category->id) }}" class="btn btn-danger delete-item"><i class="mdi mdi-trash-can"></i></a>
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
@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked=$(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: "{{route('admin.category.change-status')}}",
                method:'put',
                data: {
                    id: id,
                    status: isChecked
                },
                success: function(data){
                    toastr.success(data.message)
                },
                error: function(xhr, status,error){
                    console.log(error);
                }
            })
        })
    })
</script>
@endpush
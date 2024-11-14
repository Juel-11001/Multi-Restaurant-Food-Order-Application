@extends('admin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Banners</h4>

                    <div class="page-title-right">
                        {{-- <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol> --}}
                        {{-- <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light float-end"> <i class="mdi mdi-plus"></i> Create New</a> --}}
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#createNew"><i class="mdi mdi-plus"></i> Create New</button>
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
                                <th>Url</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)    
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset($banner->image)}}" alt="" width="70px" height="40px"></td>
                                    <td >{!! limitText($banner->url, 50) !!}</td>
                                    <td>
                                        @if ($banner->status==1)
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$banner->id}}" checked="{{$banner->status}}">
                                            </div>
                                            <span class="badge bg-success"></span>
                                        @else
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$banner->id}}">
                                        </div>
                                            <span class="badge bg-danger"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update" data-id="{{$banner->id}}" onclick="updateData({{$banner->id}})"><i class="far fa-edit"></i> </button>
                                        <a href="{{ route('admin.manage-banner.destroy', $banner->id) }}" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
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
<!-- Modal create view -->
@include('admin.banner.create')
<!-- Modal edit view -->
@include('admin.banner.edit')
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked=$(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: "{{route('admin.manage-banner.change-status')}}",
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
<script>
    function updateData(id){
        $.ajax({
            url: "{{route('admin.manage-banner.edit', ':id')}}".replace(':id', id),
            method:'get',
            success: function(data){
                // console.log("Image path from AJAX response:", data.image);
                $('#banner_url').val(data.url);
                $('select.status_update').val(data.status);
                const fullImageUrl = "{{ asset('') }}" + data.image;
                $('#previewImage').attr('src', fullImageUrl);
                $('#updateForm').attr('action', "{{ route('admin.manage-banner.update', ':id') }}".replace(':id', id));
            },
            error: function(xhr, status,error){
                console.log(error);
            }
        })
    }
</script>
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
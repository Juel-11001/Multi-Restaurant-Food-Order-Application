@extends('admin.layouts.master')
{{-- @section('title', 'Manage Products') --}}
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">All Restaurant User Pending</h4>

                    {{-- <div class="page-title-right">
                        <a href="{{ route('admin.manage-product.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light float-end"> <i class="mdi mdi-plus"></i> Create New</a>
                    </div> --}}

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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users  as $user)    
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset($user->image)}}" alt="{{$user->name}}" width="70px" height="40px" ></td>
                                    <td>{{limitText($user->name, 60)}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        @if ($user->status==1)
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$user->id}}" checked="{{$user->status}}">
                                            </div>
                                            <span class="badge bg-success"></span>
                                        @else
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$user->id}}">
                                        </div>
                                            <span class="badge bg-danger"></span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <a href="{{ route('admin.manage-product.edit', $product->id) }}" class="btn btn-primary"><i class="far fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.manage-product.destroy', $product->id) }}" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
                                    </td> --}}
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
                url: "{{route('admin.manage-restaurant-user.change-status')}}",
                method:'put',
                data: {
                    id: id,
                    status: isChecked,
                },
                success: function(data){
                    if (data.reload) {
                    location.reload();
                }
                },
                error: function(xhr, status,error){
                    console.log(error);
                }
            })
        })
        let statusMessage = "{{ session('statusMessage') }}";
        if (statusMessage) {
        toastr.success(statusMessage);
        }
    })
</script>
@endpush
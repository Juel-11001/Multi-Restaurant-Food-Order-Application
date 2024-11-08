@extends('client.layouts.master')
@section('title', 'Coupon')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Coupon</h4>

                    <div class="page-title-right">
                        <a href="{{ route('client.coupon.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light float-end"> <i class="mdi mdi-plus"></i> Create New</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Discount</th>
                                <th>Validity</th>
                                <th>Validity Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)    
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->discount}}%</td>
                                    <td>{{Carbon\Carbon::parse($coupon->validity)->format('D, d F Y')}}</td>
                                    <td>
                                        @if ($coupon->validity>=Carbon\Carbon::now())
                                            <span class="badge bg-success fz">Active</span>
                                        @else
                                            <span class="badge bg-danger fz">Expired</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coupon->status==1)
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$coupon->id}}" checked="{{$coupon->status}}">
                                            </div>
                                            <span class="badge bg-success"></span>
                                        @else
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$coupon->id}}">
                                        </div>
                                            <span class="badge bg-danger"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('client.coupon.edit', $coupon->id) }}" class="btn btn-primary"><i class="far fa-edit"></i>
                                        </a>
                                        <a href="{{ route('client.coupon.destroy', $coupon->id) }}" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
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
                url: "{{route('client.coupon.change-status')}}",
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
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
                        <a href="{{ route('client.product.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light float-end"> <i class="mdi mdi-plus"></i> Create New</a>
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
                                <th style="width:200px">Name</th>
                                <th>Menu</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)    
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset($product->image)}}" alt="{{$product->name}}" width="70px" height="40px" ></td>
                                    <td>{{Str::limit($product->name, 60)}}</td>
                                    <td>{{$product->menu->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>
                                        @if ($product->discount_price != null)
                                            @php
                                                // $amount=$product->price - $product->discount_price;
                                                $discount=($product->discount_price/$product->price)*100;
                                                // dd($discount);
                                            @endphp
                                            <span class="badge bg-success" style="font-size: 13px">{{round($discount)}}%</span>
                                        @else
                                            <span class="badge bg-danger" style="font-size: 13px">0%</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->status==1)
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$product->id}}" checked="{{$product->status}}">
                                            </div>
                                            <span class="badge bg-success"></span>
                                        @else
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input change-status" id="customSwitchsizemd" data-id="{{$product->id}}">
                                        </div>
                                            <span class="badge bg-danger"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('client.product.edit', $product->id) }}" class="btn btn-primary"><i class="far fa-edit"></i>
                                        </a>
                                        <a href="{{ route('client.product.destroy', $product->id) }}" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>
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
                url: "{{route('client.product.change-status')}}",
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
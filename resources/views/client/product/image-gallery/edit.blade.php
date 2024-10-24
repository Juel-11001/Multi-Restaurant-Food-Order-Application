@extends('client.layouts.master')
{{-- @section('title', 'Image Gallery') --}}
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Image Gallery</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashbaord</a></li>
                                <li class="breadcrumb-item active">Update Image Gallery</li>
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
                            <h4 class="card-title m-0">Update Image Gallery</h4>
                            <a href="{{ route('client.product.index') }}"
                                class="btn btn-primary btn-rounded waves-effect waves-light">
                                <i class="mdi mdi-arrow-left-thin"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div>
                                    <form action="{{ route('client.gallery.update', $imageGallery->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="example-text-input" class="form-label">Image</label>
                                                <input class="form-control" name="image" type="file" value=""
                                                    id="image">
                                            </div>
                                            <div class="mb-3 col-md-6 ml-5">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xl me-3">
                                                        <img src="{{ asset($imageGallery->image) }}" alt=""
                                                            class="rounded-circle p-1 bg-primary" id="showImage"
                                                            width="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary w-md">Update</button>
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
        $(document).ready(function() {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })
        })
    </script>
@endpush

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
                                <li class="breadcrumb-item active">Create Image Gallery</li>
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
                            <h4 class="card-title m-0">Create Image Gallery</h4>
                            <a href="{{ route('client.product.index') }}"
                                class="btn btn-primary btn-rounded waves-effect waves-light">
                                <i class="mdi mdi-arrow-left-thin"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div>
                                    <form action="{{ route('client.gallery.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="example-text-input" class="form-label">Image</label>
                                                <input class="form-control" name="images[]" type="file" value=""
                                                    id="multiImg" multiple>
                                            </div>
                                            <div class=" row mt-3 mb-3" id="preview_img">
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
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
    </script>
@endpush

@extends('client.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xl me-3">
                                                <img src="{{ !empty($profileData->image) ? url('uploads/client_profile/' . $profileData->image) : url('uploads/no_image.jpg') }}"
                                                    alt="" class="img-fluid rounded-circle d-block">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-16 mb-1">{{ $profileData->name }}</h5>
                                                <p class="text-muted font-size-13">{{ $profileData->email }}</p>

                                                <div
                                                    class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                    <div>
                                                        <i
                                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profileData->phone }}
                                                    </div>
                                                    <div>
                                                        <i
                                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profileData->address }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->


                    <!-- end tab content -->
                </div>
                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <form action="{{ route('client.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Name</label>
                                                <input class="form-control" name="name" type="text"
                                                    value="{{ $profileData->name }}" id="example-text-input">
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-email-input" class="form-label">Email</label>
                                                <input class="form-control" name="email" type="email"
                                                    value="{{ $profileData->email }}" id="example-email-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-tel-input" class="form-label">Phone</label>
                                                <input class="form-control" name="phone" type="tel"
                                                    value="{{ $profileData->phone }}" id="example-tel-input">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input" class="form-label">Address</label>
                                            <textarea id="basicpill-address-input" class="form-control" rows="2" placeholder="Enter your Address"
                                                name="address">{!! $profileData->address !!}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Image</label>
                                            <input class="form-control" name="image" type="file" value=""
                                                id="image">
                                        </div>
                                        <div class="mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img src="{{ !empty($profileData->image) ? asset('uploads/client_profile/' . $profileData->image) : asset('uploads/no_image.jpg') }}"
                                                        alt="" class="rounded-circle p-1 bg-primary" id="showImage"
                                                        width="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-xl-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <select class="form-select" name="city_id">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option {{ $profileData->city_id == $city->id ? 'selected' : '' }}
                                                        value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-xl-6 col-md-6 mt-2">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input" class="form-label">Shop Info</label>
                                            <textarea id="basicpill-address-input" class="form-control" rows="3" placeholder="Enter your Shop Info"
                                                name="shop_info">{!! $profileData->shop_info !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row col-xl-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Cover Image</label>
                                            <input class="form-control" name="cover_image" type="file" value=""
                                                id="cover_image">
                                        </div>
                                    </div>
                                    <div class="row col-xl-6 col-md-6">
                                        <div class="mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img src="{{ !empty($profileData->cover_image) ? asset('uploads/client_profile/' . $profileData->cover_image) : asset('uploads/no_image.jpg') }}"
                                                        alt="" class=" p-1 bg-primary" id="showCoverImage"
                                                        width="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-primary w-md">Save Changes</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
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
            });

            $('#cover_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#showCoverImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        })
    </script>
@endpush

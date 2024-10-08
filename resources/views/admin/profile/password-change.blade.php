@extends('admin.layouts.master')

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
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xl me-3">
                                                <img src="{{ !empty($profile->photo) ? url('uploads/admin_profile/' . $profile->photo) : url('uploads/no_image.jpg') }}"
                                                    alt="" class="img-fluid rounded-circle d-block">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-16 mb-1">{{ $profile->name }}</h5>
                                                <p class="text-muted font-size-13">{{ $profile->email }}</p>

                                                <div
                                                    class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                    <div>
                                                        <i
                                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profile->phone }}
                                                    </div>
                                                    <div>
                                                        <i
                                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profile->address }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-auto order-1 order-sm-2">
                                    <div class="d-flex align-items-start justify-content-end gap-2">
                                        <div>
                                            <div class="dropdown">
                                                <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->


                    <!-- end tab content -->
                </div>
                <!-- end col -->
            </div>

            <div class="card">
                <div class="card-body p-4">

                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <form  method="POST" action="{{ route('admin.profile.password-update') }}" class="row gx-3 gy-2 align-items-center mb-4 mb-lg-0">
                                @csrf
                                <div class="col-sm-4">
                                    <label class="form-label" for="formrow-password-input">Old Password</label>
                                    <input type="password" class="form-control" @error('old_password') is-invalid @enderror name="old_password" value="" id="old_password"
                                        placeholder="Enter your old password">
                                        @error('old_password')
                                        <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label" for="formrow-password-input">New Password</label>
                                    <input type="password" class="form-control" @error('new_password') is-invalid @enderror name="new_password" value="" id="new_password" @error('new_password') @enderror placeholder="Enter your new password">
                                    @error('new_password')
                                    <span class="text-danger">{{$message}}</span>
                                 @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label" for="formrow-password-input">Confirm Password</label>
                                    <input type="password" class="form-control"
                                        @error('new_password_confirmation') is-invalid @enderror name="new_password_confirmation" value="" id="new_password_confirmation"
                                        placeholder="Enter Confirm password">
                                        @error('new_password_confirmation')
                                        <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- end row -->

    </div> <!-- container-fluid -->
    </div>
@endsection


@extends('frontend.dashboard.layouts.master')
@section('title')
    User Dashboard
@endsection
@section('content')
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp
    <section class="section pt-4 pb-4 osahan-account-page">
        <div class="container">
            <div class="row">
                <!-- sidebar -->
                @include('frontend.dashboard.section.sidebar')
                <div class="col-md-9">
                    <div class="osahan-account-page-right rounded shadow-sm bg-white p-4">
                        <div class="tab-content" id="myTabContent">
                            <!-- password -->
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <form  method="POST" action="{{ route('user.update.password') }}" class="row gx-3 gy-2 align-items-center mb-4 mb-lg-0">
                                        @csrf
                                        <div class="col-sm-12 mt-2">
                                            <label class="form-label" for="formrow-password-input">Old Password</label>
                                            <input type="password" class="form-control" @error('old_password') is-invalid @enderror name="old_password" value="" id="old_password"
                                                placeholder="Enter your old password">
                                                @error('old_password')
                                                <span class="text-danger">{{$message}}</span>
                                             @enderror
                                        </div>
                                        <div class="col-sm-12  mt-2">
                                            <label class="form-label" for="formrow-password-input">New Password</label>
                                            <input type="password" class="form-control" @error('new_password') is-invalid @enderror name="new_password" value="" id="new_password" @error('new_password') @enderror placeholder="Enter your new password">
                                            @error('new_password')
                                            <span class="text-danger">{{$message}}</span>
                                         @enderror
                                        </div>
                                        <div class="col-sm-12  mt-2">
                                            <label class="form-label" for="formrow-password-input">Confirm Password</label>
                                            <input type="password" class="form-control"
                                                @error('new_password_confirmation') is-invalid @enderror name="new_password_confirmation" value="" id="new_password_confirmation"
                                                placeholder="Enter Confirm password">
                                                @error('new_password_confirmation')
                                                <span class="text-danger">{{$message}}</span>
                                             @enderror
                                        </div>
                                        <div class="col-md-4 mt-4">
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
    </section>
@endsection


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
                    <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">
                        <div class="tab-content" id="myTabContent">

                            <!-- profile -->
                            @include('frontend.dashboard.section.profile')
                            <!-- orders -->
                            @include('frontend.dashboard.section.orders')

                            <!-- offers -->
                            @include('frontend.dashboard.section.offers')

                            <!-- favourite -->
                            @include('frontend.dashboard.section.favourite')

                            <!-- payment -->
                            @include('frontend.dashboard.section.payment')

                            <!-- address -->
                            @include('frontend.dashboard.section.address')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
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

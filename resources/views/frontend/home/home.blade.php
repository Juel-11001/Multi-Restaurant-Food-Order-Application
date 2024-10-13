@extends('frontend.layouts.master')
@section('content')

   <!--============================
        Product Box
    ==============================-->
    @include('frontend.home.section.product-box')
    <!--============================
        Product Box End
    ==============================-->
   <!--============================
        Popular Brands
    ==============================-->
    @include('frontend.home.section.popular-brands')
    <!--============================
        Popular Brands End
    ==============================-->
     <!--============================
        Become Member
    ==============================-->
    @include('frontend.home.section.become-member')
    <!--============================
        Become Member End
    ==============================-->

    <!--============================
        Work With Us
    ==============================-->
    @include('frontend.home.section.work-with-us')
  <!--============================
        Work With Us End    
    ==============================-->
    <!--============================
        Footer  
    ==============================-->
    @include('frontend.home.section.footer')
    <!--============================
        Footer  End
    ==============================-->
    <!--============================
        Popular
    ==============================-->
    @include('frontend.home.section.popular')
    <!--============================
        Popular End
    ==============================-->
    

@endsection
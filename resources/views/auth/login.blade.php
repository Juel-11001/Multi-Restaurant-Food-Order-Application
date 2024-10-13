@extends('layouts.master-auth')
@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
       <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
       <div class="col-md-8 col-lg-6">
          <div class="login d-flex align-items-center py-5">
             <div class="container">
                <div class="row">
                   <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                      <h3 class="login-heading mb-4">Welcome back!</h3>
                      @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <code><li>{{ $error }}</li></code>
                            @endforeach
                        @endif
                        @if (Session::has('success'))
                            <code><li>{{ Session::get('success') }}</li></code>
                        @endif
                        @if (Session::has('error'))
                            <code><li>{{ Session::get('error') }}</li></code>
                        @endif
                      <form method="POST" action="{{ route('login') }}">
                          @csrf
                          <!-- Email Address -->
                         <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" >
                            <label for="inputEmail">Email</label>
                         </div>
                          <!-- Password -->
                         <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                            <label for="inputPassword">Password</label>
                         </div>
                         <!-- Remember Me -->
                         <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1" name="remember" >Remember password</label>
                         </div>
                         <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign in</button>
                         <div class="text-center pt-3">
                            Don’t have an account? <a class="font-weight-bold" href="{{route('register')}}">Sign Up</a>
                         </div>
                      </form>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection

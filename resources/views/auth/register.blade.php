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
                      <h3 class="login-heading mb-4">New Buddy!</h3>
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
                      <form method="POST" action="{{ route('register') }}">
                        @csrf
                         <!-- Name -->
                         <div class="form-label-group">
                            <input type="text" id="name" class="form-control" placeholder="Name" name="name">
                            <label for="name">Name</label>
                         </div>
                          <!-- Email Address -->
                         <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email">
                            <label for="inputEmail">Email</label>
                         </div>
                         <!-- Password -->
                         <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                            <label for="inputPassword">Password</label>
                         </div>
                         <!-- Confirm Password -->
                         <div class="form-label-group mb-4">
                            <input type="password" name="password_confirmation" id="ptext" class="form-control" placeholder="Confirm Password">
                            <label for="ptext">Confirm Password</label>
                         </div>
                         <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign Up</button>
                        </form>
                         <div class="text-center pt-3">
                            Already have an Account? <a class="font-weight-bold" href="{{route('login')}}">Sign In</a>
                         </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
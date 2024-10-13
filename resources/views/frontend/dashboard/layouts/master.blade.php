<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <title>@yield('title')</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="{{asset('frontend/img/favicon.png')}}">
      <!-- Bootstrap core CSS-->
      <link href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{asset('frontend/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{asset('frontend/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
      <!-- Select2 CSS-->
      <link href="{{asset('frontend/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{asset('frontend/css/osahan.css')}}" rel="stylesheet">
      <!-- toastr css -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
   </head>
   <body>
      {{-- <!-- Modal -->
      <div class="modal fade" id="edit-profile-modal" tabindex="-1" role="dialog" aria-labelledby="edit-profile" aria-hidden="true">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="edit-profile">Edit profile</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label>Phone number
                           </label>
                           <input type="text" value="+91 85680-79956" class="form-control" placeholder="Enter Phone number">
                        </div>
                        <div class="form-group col-md-12">
                           <label>Email id
                           </label>
                           <input type="text" value="iamosahan@gmail.com" class="form-control" placeholder="Enter Email id
                              ">
                        </div>
                        <div class="form-group col-md-12 mb-0">
                           <label>Password
                           </label>
                           <input type="password" value="**********" class="form-control" placeholder="Enter password
                              ">
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                  </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">UPDATE</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Delivery Area</label>
                           <div class="input-group">
                              <input type="text" class="form-control" placeholder="Delivery Area">
                              <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-ui-pointer"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Complete Address
                           </label>
                           <input type="text" class="form-control" placeholder="Complete Address e.g. house number, street name, landmark">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Delivery Instructions
                           </label>
                           <input type="text" class="form-control" placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall">
                        </div>
                        <div class="form-group mb-0 col-md-12">
                           <label for="inputPassword4">Nickname
                           </label>
                           <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
                              <label class="btn btn-info active">
                              <input type="radio" name="options" id="option1" autocomplete="off" checked> Home
                              </label>
                              <label class="btn btn-info">
                              <input type="radio" name="options" id="option2" autocomplete="off"> Work
                              </label>
                              <label class="btn btn-info">
                              <input type="radio" name="options" id="option3" autocomplete="off"> Other
                              </label>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                  </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="delete-address-modal" tabindex="-1" role="dialog" aria-labelledby="delete-address" aria-hidden="true">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="delete-address">Delete</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p class="mb-0 text-black">Are you sure you want to delete this xxxxx?</p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                  </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">DELETE</button>
               </div>
            </div>
         </div>
      </div> --}}

      <!-- navbar Header -->
      @include('frontend.dashboard.layouts.header')

      
      <!-- content -->
      @yield('content')

      
      <!-- footer -->
      @include('frontend.dashboard.layouts.footer')

      <!-- jQuery -->
      <script src="{{asset('frontend/vendor/jquery/jquery-3.3.1.slim.min.js')}}"></script>
      <!-- Bootstrap core JavaScript-->
      <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <!-- Select2 JavaScript-->
      <script src="{{asset('frontend/vendor/select2/js/select2.min.js')}}"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{asset('frontend/js/custom.js')}}"></script>
      <!-- jq cdn -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <!-- toastr js -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script>
          @if(Session::has('message'))
          var type = "{{ Session::get('alert-type','info') }}"
          switch(type){
             case 'info':
             toastr.info(" {{ Session::get('message') }} ");
             break;

             case 'success':
             toastr.success(" {{ Session::get('message') }} ");
             break;

             case 'warning':
             toastr.warning(" {{ Session::get('message') }} ");
             break;

             case 'error':
             toastr.error(" {{ Session::get('message') }} ");
             break;
          }
          @endif
         </script>
      @stack('scripts')
   </body>
</html>
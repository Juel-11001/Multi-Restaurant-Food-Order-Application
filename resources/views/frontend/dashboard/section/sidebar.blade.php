<div class="col-md-3">
    <div class="osahan-account-page-left shadow-sm rounded bg-white h-100">
       <div class="border-bottom p-4">
          <div class="osahan-user text-center">
             <div class="osahan-user-media">
                <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{!empty($profileData->image) ? asset('uploads/user_profile/' . $profileData->image) : asset('uploads/no_image.jpg')}}" alt="gurdeep singh osahan">
                <div class="osahan-user-media-body">
                   <h6 class="mb-2">{{$profileData->name}}</h6>
                   <p class="mb-1">{{$profileData->phone}}</p>
                   <p>{{$profileData->email}}</p>
                </div>
             </div>
          </div>
       </div>
       <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
          <li class="nav-item">
             <a class="nav-link {{Route::currentRouteName() == 'dashboard' ? 'active' : ''}}"  href="{{route('dashboard')}}" role="tab" aria-controls="profile" aria-selected="true"><i class="icofont-user"></i> Profile</a>
          </li>
          <li class="nav-item">
             <a class="nav-link {{Route::currentRouteName() == 'user.change.password' ? 'active' : ''}}" href="{{route('user.change.password')}}" role="tab" aria-controls="change-password" aria-selected="true"><i class="icofont-user"></i> Change Password</a>
          </li>
       </ul>
    </div>
 </div>
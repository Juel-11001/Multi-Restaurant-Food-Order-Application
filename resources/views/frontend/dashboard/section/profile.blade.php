<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Name</label>
                        <input class="form-control" name="name" type="text" value="{{ $profileData->name }}"
                            id="example-text-input">
                    </div>

                    <div class="mb-3">
                        <label for="example-email-input" class="form-label">Email</label>
                        <input class="form-control" name="email" type="email" value="{{ $profileData->email }}"
                            id="example-email-input">
                    </div>
                    <div class="mb-3">
                        <label for="example-tel-input" class="form-label">Phone</label>
                        <input class="form-control" name="phone" type="tel" value="{{ $profileData->phone }}"
                            id="example-tel-input">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Save Changes</button>
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
                    <input class="form-control" name="image" type="file" value="" id="image">
                </div>
                <div class="mb-3">
                    <div class="flex-shrink-0">
                        <div class="avatar-xl me-3">
                            <img src="{{ !empty($profileData->image) ? asset('uploads/user_profile/' . $profileData->image) : asset('uploads/no_image.jpg') }}"
                                alt="" class="rounded-circle p-1 bg-primary" id="showImage" width="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

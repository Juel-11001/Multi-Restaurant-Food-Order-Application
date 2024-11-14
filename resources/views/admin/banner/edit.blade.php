<div id="update" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Update City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="updateForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="formrow-firstname-input">Url</label>
                            <input type="text" class="form-control" id="banner_url" placeholder="Enter Url" name="url">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="example-text-input" class="form-label">Image</label>
                        <input class="form-control" name="image" type="file" value=""
                            id="image">
                    </div>
                    <div class="mb-3 col-md-12">
                        <div class="flex-shrink-0">
                            <div class="avatar-xl me-3">
                                <img src="" alt=""
                                    class="rounded-circle p-1 bg-primary" id="previewImage"
                                    width="100">
                            </div>
                        </div>
                    </div>
                    
                </div>
                    {{-- <div class="">
                        <button type="submit" class="btn btn-primary w-md">Create</button>
                    </div> --}}
               
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
<div id="update" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Update City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="updateForm" method="post">
                @csrf
                @method('PUT')
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-firstname-input">Name</label>
                                <input type="text" class="form-control" id="city_name"  name="name">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select status_update" name="status" class="status_update">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
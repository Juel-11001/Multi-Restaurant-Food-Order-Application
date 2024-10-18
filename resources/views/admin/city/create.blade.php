<div id="createNew" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Create City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.city.store') }}" method="post">
                @csrf
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-firstname-input">Name</label>
                                <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter City Name" name="name">
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
                        
                    </div>
                    {{-- <div class="">
                        <button type="submit" class="btn btn-primary w-md">Create</button>
                    </div> --}}
               
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Add Service Button -->
<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addServiceModal">
    Add Service
</button>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="serviceForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.services.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="addServiceModalLabel">Add Service</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="formErrors" class="alert alert-danger d-none"></div>

                    <div class="form-group">
                        <label for="name">Service Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter service name"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2" placeholder="Short description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="descriptionEditor" class="form-control ckeditor" rows="5"
                            placeholder="Enter full description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration" class="form-control" placeholder="e.g., 30 mins, 1 hour">
                    </div>

                    <div class="form-group">
                        <label for="image">Service Image</label>
                        <input type="file" name="image" accept="image/*" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

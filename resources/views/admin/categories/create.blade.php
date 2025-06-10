<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-lg">
    Add Category
</button>

<div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="modal-lg-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="categoryForm" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-lg-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetForm()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="formErrors" class="alert alert-danger d-none"></div>

                    <div class="form-group">
                        <label for="name">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Enter category name" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Category Image (optional)</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="resetForm()">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitCategoryForm()">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

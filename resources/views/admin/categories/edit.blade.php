<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-{{ $category->id }}">
    Edit
</button>

<div class="modal fade" id="modal-edit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="categoryEditForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-edit-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="editFormErrors" class="alert alert-danger d-none"></div>

                    <div class="form-group">
                        <label for="edit-name">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="edit-name" name="name" class="form-control"
                            placeholder="Enter category name" required value="{{ $category->name }}">
                    </div>

                    <div class="form-group">
                        <label for="edit-image">Category Image (optional)</label>
                        <input type="file" id="edit-image" name="image" accept="image/*" class="form-control-file">
                        <small class="form-text text-muted">Leave empty to keep current image.</small>
                        <img src="{{ asset($category->image) }}" alt="" width="100">
                    </div>

                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select id="edit-status" name="status" class="form-control" required>
                            <option value="1" {{ $category->status === 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $category->status === 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="resetEditForm()">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitEditCategoryForm()">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

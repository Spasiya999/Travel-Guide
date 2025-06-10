<!-- Edit Service Button -->
<button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
    data-target="#editServiceModal-{{ $service->id }}">
    Edit
</button>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal-{{ $service->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editServiceModalLabel-{{ $service->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="editServiceForm-{{ $service->id }}" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.services.update', $service->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title" id="editServiceModalLabel-{{ $service->id }}">Edit Service</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="editFormErrors-{{ $service->id }}" class="alert alert-danger d-none"></div>

                    <div class="form-group">
                        <label for="name">Service Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2">{{ $service->short_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="descriptionEditor-{{ $service->id }}" class="form-control ckeditor" rows="5">{{ $service->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration" class="form-control" value="{{ $service->duration }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Service Image</label><br>
                        @if ($service->image)
                            <img src="{{ asset($service->image) }}" alt="Service Image" class="img-thumbnail mb-2"
                                width="120">
                        @endif
                        <input type="file" name="image" accept="image/*" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $service->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $service->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$service->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

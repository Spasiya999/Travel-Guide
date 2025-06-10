<!-- Edit Place Button -->
<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPlaceModal-{{ $place->id }}">
    Edit
</button>

<!-- Edit Place Modal -->
<div class="modal fade" id="editPlaceModal-{{ $place->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editPlaceModalLabel-{{ $place->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.places.update', $place->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title" id="editPlaceModalLabel-{{ $place->id }}">Edit Place</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $place->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control ckeditor" rows="4">{{ $place->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label><br>
                        @if ($place->image)
                            <img src="{{ asset($place->image) }}" alt="Image" class="img-thumbnail mb-2"
                                width="120">
                        @endif
                        <input type="file" name="image" class="form-control-file" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $place->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$place->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Place</button>
                </div>
            </form>
        </div>
    </div>
</div>

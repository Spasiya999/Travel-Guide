<!-- Edit Testimonial Button -->
<button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
    data-target="#editTestimonialModal-{{ $testimonial->id }}">
    Edit
</button>

<!-- Edit Testimonial Modal -->
<div class="modal fade" id="editTestimonialModal-{{ $testimonial->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editTestimonialModalLabel-{{ $testimonial->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="editTestimonialForm-{{ $testimonial->id }}" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.testimonials.update', $testimonial->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title" id="editTestimonialModalLabel-{{ $testimonial->id }}">Edit Testimonial</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="editFormErrors-{{ $testimonial->id }}" class="alert alert-danger d-none"></div>

                    <div class="form-group">
                        <label for="name">Client Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="4" required>{{ $testimonial->message }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" value="{{ $testimonial->country }}">
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $testimonial->date }}">
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ $testimonial->rating }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Main Image</label><br>
                        @if ($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="Image" class="img-thumbnail mb-2" width="120">
                        @endif
                        <input type="file" name="image" accept="image/*" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="user_image">User Avatar</label><br>
                        @if ($testimonial->user_image)
                            <img src="{{ asset($testimonial->user_image) }}" alt="User Image" class="img-thumbnail mb-2" width="80">
                        @endif
                        <input type="file" name="user_image" accept="image/*" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="service_id">Related Service</label>
                        <select name="service_id" class="form-control">
                            <option value="">Select Service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ $testimonial->service_id == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $testimonial->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $testimonial->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$testimonial->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="is_approved">Approval Status</label>
                        <select name="is_approved" class="form-control">
                            <option value="">Select</option>
                            <option value="1" {{ $testimonial->is_approved ? 'selected' : '' }}>Approved</option>
                            <option value="0" {{ !$testimonial->is_approved ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>

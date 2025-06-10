<!-- Add Testimonial Button -->
<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addTestimonialModal">
    Add Testimonial
</button>

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="testimonialForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.testimonials.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="addTestimonialModalLabel">Add Testimonial</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Client Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter client name" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Enter testimonial message" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" placeholder="Enter country">
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <input type="number" name="rating" class="form-control" min="1" max="5">
                    </div>

                    <div class="form-group">
                        <label for="image">Main Image (optional)</label>
                        <input type="file" name="image" class="form-control-file" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="user_image">User Avatar (optional)</label>
                        <input type="file" name="user_image" class="form-control-file" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="service_id">Related Service</label>
                        <select name="service_id" class="form-control">
                            <option value="">Select Service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
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

                    <div class="form-group">
                        <label for="is_approved">Approval Status</label>
                        <select name="is_approved" class="form-control">
                            <option value="">Select</option>
                            <option value="1">Approved</option>
                            <option value="0">Pending</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>

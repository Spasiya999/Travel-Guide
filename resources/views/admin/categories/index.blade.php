@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('admin.common.alert')
                    <div class="card">
                        <div class="card-header align-items-center">
                            <h3 class="card-title">Categories Table</h3>
                            @include('admin.categories.create')
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td><img src="{{ asset($category->image) }}" alt="Category Image"
                                                    width="100"></td>
                                            <td>
                                                @if ($category->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @include('admin.categories.edit')
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function resetForm() {
            document.getElementById('categoryForm').reset();
            const errorDiv = document.getElementById('formErrors');
            errorDiv.innerHTML = '';
            errorDiv.classList.add('d-none');
        }

        function submitCategoryForm() {
            const form = document.getElementById('categoryForm');
            const name = form.name.value.trim();
            const status = form.status.value;
            const imageInput = form.image;

            const errors = [];

            // Validation
            if (!name) {
                errors.push('Category name is required.');
            }

            if (status !== "0" && status !== "1") {
                errors.push('Please select a valid status.');
            }

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    errors.push('Image must be JPG or PNG.');
                }
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    errors.push('Image size must be less than 2MB.');
                }
            }

            const errorDiv = document.getElementById('formErrors');

            if (errors.length > 0) {
                errorDiv.innerHTML = errors.map(e => `<p>${e}</p>`).join('');
                errorDiv.classList.remove('d-none');
                return;
            } else {
                errorDiv.innerHTML = '';
                errorDiv.classList.add('d-none');
            }

            // Submit the form (normal form submit, you can replace with AJAX if needed)
            form.submit();
        }

        // Validate and submit the edit form
        function submitEditCategoryForm() {
            const form = document.getElementById('categoryEditForm');
            const name = form.name.value.trim();
            const status = form.status.value;
            const imageInput = form.image;

            const errors = [];

            // Validation
            if (!name) {
                errors.push('Category name is required.');
            }

            if (status !== "0" && status !== "1") {
                errors.push('Please select a valid status.');
            }

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    errors.push('Image must be JPG or PNG.');
                }
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    errors.push('Image size must be less than 2MB.');
                }
            }

            const errorDiv = document.getElementById('editFormErrors');

            if (errors.length > 0) {
                errorDiv.innerHTML = errors.map(e => `<p>${e}</p>`).join('');
                errorDiv.classList.remove('d-none');
                return;
            } else {
                errorDiv.innerHTML = '';
                errorDiv.classList.add('d-none');
            }

            // Submit the form
            form.submit();
        }
    </script>
@endsection

@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
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
                            <h3 class="card-title">Gallery Images</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#createGalleryModal">
                                    <i class="fas fa-plus"></i> Add New Image
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($galleries as $index => $gallery)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <img src="{{ asset($gallery->image) }}" alt="Gallery Image" width="100"
                                                    height="60" class="img-thumbnail">
                                            </td>
                                            <td>
                                                @if ($gallery->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $gallery->created_at->format('d M Y') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#editGalleryModal"
                                                    onclick="openEditModal({{ $gallery->id }}, '{{ asset($gallery->image) }}', {{ $gallery->status }}, {{ $gallery->is_featured ?? 0 }})">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this gallery image?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
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

    <!-- Create Gallery Modal -->
    <div class="modal fade" id="createGalleryModal" tabindex="-1" role="dialog" aria-labelledby="createGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGalleryModalLabel">Add New Gallery Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image">Gallery Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*" value="{{ old('image') }}">
                            <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG. Max size: 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_featured">Is Featured <span class="text-danger">*</span></label>
                            <select class="form-control @error('is_featured') is-invalid @enderror"
                                    id="is_featured" name="is_featured">
                                <option value="0" {{ old('is_featured', '0') == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('is_featured')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Gallery Modal -->
    <div class="modal fade" id="editGalleryModal" tabindex="-1" role="dialog" aria-labelledby="editGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="galleryEditForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGalleryModalLabel">Edit Gallery Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Current Image</label>
                            <div>
                                <img id="currentImage" src="" alt="Current Image" width="150" height="100"
                                    class="img-thumbnail">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="editImage">New Image (Optional)</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                   id="editImage" name="image" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current image. Allowed formats: JPG,
                                JPEG, PNG. Max size: 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="editIsFeatured">Is Featured <span class="text-danger">*</span></label>
                            <select class="form-control @error('is_featured') is-invalid @enderror"
                                    id="editIsFeatured" name="is_featured">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @error('is_featured')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="editStatus">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror"
                                    id="editStatus" name="status">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script>
        function openEditModal(id, imagePath, status, isFeatured) {
            const form = document.getElementById('galleryEditForm');
            const currentImage = document.getElementById('currentImage');
            const editStatus = document.getElementById('editStatus');
            const editIsFeatured = document.getElementById('editIsFeatured');

            form.action = `/admin/galleries/${id}`;
            currentImage.src = imagePath.startsWith('http') ? imagePath : '{{ asset('') }}' + imagePath;
            editStatus.value = status;
            editIsFeatured.value = isFeatured;
            document.getElementById('editImage').value = '';
        }

        // Initialize DataTable (if using AdminLTE DataTables)
        $(document).ready(function () {
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        @if($errors->any() && session('modal') == 'create')
            $(document).ready(function() {
                $('#createGalleryModal').modal('show');
            });
        @endif

        @if($errors->any() && session('modal') == 'edit')
            $(document).ready(function() {
                $('#editGalleryModal').modal('show');
            });
        @endif
    </script>
@endsection

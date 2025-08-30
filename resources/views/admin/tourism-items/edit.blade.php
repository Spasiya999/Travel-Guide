@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Tourism Item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tourism-items.index') }}">Tourism Items</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Edit Tourism Item: {{ $tourismItem->name }}</h3>
                        </div>

                        <form action="{{ route('admin.tourism-items.update', $tourismItem->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $tourismItem->name) }}"
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Type <span class="text-danger">*</span></label>
                                            <select class="form-control @error('type') is-invalid @enderror" id="type"
                                                name="type" required>
                                                <option value="">Select Type</option>
                                                <option value="national_park"
                                                    {{ old('type', $tourismItem->type) == 'national_park' ? 'selected' : '' }}>
                                                    National Park</option>
                                                <option value="heritage_site"
                                                    {{ old('type', $tourismItem->type) == 'heritage_site' ? 'selected' : '' }}>
                                                    Heritage Site</option>
                                                <option value="activity"
                                                    {{ old('type', $tourismItem->type) == 'activity' ? 'selected' : '' }}>
                                                    Activity</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text"
                                                class="form-control @error('location') is-invalid @enderror" id="location"
                                                name="location" value="{{ old('location', $tourismItem->location) }}">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration">Duration</label>
                                            <input type="text"
                                                class="form-control @error('duration') is-invalid @enderror" id="duration"
                                                name="duration" value="{{ old('duration', $tourismItem->duration) }}"
                                                placeholder="e.g., 2 hours, Half day">
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price_usd">Price USD <span class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @error('price_usd') is-invalid @enderror" id="price_usd"
                                                name="price_usd" value="{{ old('price_usd', $tourismItem->price_usd) }}"
                                                step="0.01" min="0" required>
                                            @error('price_usd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price_lkr">Price LKR <span class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @error('price_lkr') is-invalid @enderror" id="price_lkr"
                                                name="price_lkr" value="{{ old('price_lkr', $tourismItem->price_lkr) }}"
                                                step="0.01" min="0" required>
                                            @error('price_lkr')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control ckeditor @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3">{{ old('description', $tourismItem->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                                <option value="active"
                                                    {{ old('status', $tourismItem->status) == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="inactive"
                                                    {{ old('status', $tourismItem->status) == 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check" style="margin-top: 2rem;">
                                                <input type="checkbox" class="form-check-input" id="requires_transport"
                                                    name="requires_transport" value="1"
                                                    {{ old('requires_transport', $tourismItem->requires_transport) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="requires_transport">
                                                    Requires Transport
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Features</label>
                                    <div id="features-container">
                                        @php
                                            $features = old('features', $tourismItem->features ?? []);
                                        @endphp
                                        @if (count($features) > 0)
                                            @foreach ($features as $index => $feature)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="features[]"
                                                        value="{{ $feature }}" placeholder="Enter a feature">
                                                    <div class="input-group-append">
                                                        <button type="button"
                                                            class="btn btn-outline-danger remove-feature">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="features[]"
                                                    placeholder="Enter a feature">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger remove-feature">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="add-feature">
                                        <i class="fas fa-plus"></i> Add Feature
                                    </button>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Tourism Item
                                </button>
                                <a href="{{ route('admin.tourism-items.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                                <a href="{{ route('admin.tourism-items.show', $tourismItem->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Add new feature input
            $('#add-feature').on('click', function() {
                const newFeature = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="features[]" placeholder="Enter a feature">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger remove-feature">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        `;
                $('#features-container').append(newFeature);
            });

            // Remove feature input
            $(document).on('click', '.remove-feature', function() {
                if ($('#features-container .input-group').length > 1) {
                    $(this).closest('.input-group').remove();
                }
            });
        });
    </script>
@endpush

@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Vehicle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Vehicle Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $vehicle->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Vehicle Type *</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type"
                                    name="type" required>
                                    <option value="">Select Type</option>
                                    @foreach (['car', 'van', 'minibus', 'bus', 'coach', 'luxury_car', 'suv'] as $type)
                                        <option value="{{ $type }}"
                                            {{ old('type', $vehicle->type) == $type ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="capacity" class="form-label">Passenger Capacity *</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                    id="capacity" name="capacity" value="{{ old('capacity', $vehicle->capacity) }}"
                                    min="1" required>
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="fuel_type" class="form-label">Fuel Type *</label>
                                <select class="form-control @error('fuel_type') is-invalid @enderror" id="fuel_type"
                                    name="fuel_type" required>
                                    <option value="">Select Fuel Type</option>
                                    @foreach (['petrol', 'diesel', 'hybrid', 'electric'] as $fuel)
                                        <option value="{{ $fuel }}"
                                            {{ old('fuel_type', $vehicle->fuel_type) == $fuel ? 'selected' : '' }}>
                                            {{ ucfirst($fuel) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fuel_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cost_per_day" class="form-label">Cost Per Day ($) *</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('cost_per_day') is-invalid @enderror" id="cost_per_day"
                                    name="cost_per_day" value="{{ old('cost_per_day', $vehicle->cost_per_day) }}" required>
                                @error('cost_per_day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cost_per_km" class="form-label">Cost Per KM ($)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('cost_per_km') is-invalid @enderror" id="cost_per_km"
                                    name="cost_per_km" value="{{ old('cost_per_km', $vehicle->cost_per_km) }}">
                                @error('cost_per_km')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Features</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="ac_available" name="ac_available"
                                        value="1" {{ old('ac_available', $vehicle->ac_available) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ac_available">AC Available</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="driver_included"
                                        name="driver_included" value="1"
                                        {{ old('driver_included', $vehicle->driver_included) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="driver_included">Driver Included</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    @foreach (['active', 'inactive', 'maintenance'] as $status)
                                        <option value="{{ $status }}"
                                            {{ old('status', $vehicle->status) == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="4" required>{{ old('description', $vehicle->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Vehicle Image</label>

                                @if ($vehicle->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}"
                                            class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        <p class="text-muted small mt-1">Current Image</p>
                                    </div>
                                @endif

                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                <small class="text-muted">Leave empty to keep current image</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.vehicles') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vehicles</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary float-end">
                    <i class="fas fa-plus"></i> Add Vehicle
                </a>
            </div>
        </div>

        @include('admin.common.alert')

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicles as $key => $vehicle)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($vehicle->image)
                                        <img src="{{ asset($vehicle->image) }}" alt="Vehicle" width="50">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $vehicle->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $vehicle->status ? 'success' : 'danger' }}">
                                        {{ $vehicle->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vehicles.toggle-status', $vehicle) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($vehicle->status === 'active')
                                            <button type="submit" class="btn btn-sm btn-warning"
                                                onclick="return confirm('Are you sure you want to deactivate this vehicle?')">
                                                <i class="fas fa-ban"></i> Deactivate
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('Are you sure you want to activate this vehicle?')">
                                                <i class="fas fa-check"></i> Activate
                                            </button>
                                        @endif
                                    </form>

                                    <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this vehicle? This action cannot be undone.')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No vehicles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

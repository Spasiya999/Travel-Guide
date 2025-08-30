@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tourism Item Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tourism-items.index') }}">Tourism Items</a></li>
                        <li class="breadcrumb-item active">{{ $tourismItem->name }}</li>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $tourismItem->name }}</h3>
                            <div>
                                <a href="{{ route('admin.tourism-items.edit', $tourismItem->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.tourism-items.destroy', $tourismItem->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        {{ $tourismItem->quotations()->exists() ? 'disabled title=Cannot delete item that is used in quotations' : '' }}>
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td><strong>ID:</strong></td>
                                                <td>{{ $tourismItem->id }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Name:</strong></td>
                                                <td>{{ $tourismItem->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Type:</strong></td>
                                                <td>
                                                    <span class="badge badge-secondary">
                                                        {{ $tourismItem->getTypeDisplayName() }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Location:</strong></td>
                                                <td>{{ $tourismItem->location ?? 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Duration:</strong></td>
                                                <td>{{ $tourismItem->duration ?? 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong></td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $tourismItem->status == 'active' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($tourismItem->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td><strong>Price (USD):</strong></td>
                                                <td class="text-success font-weight-bold">
                                                    ${{ number_format($tourismItem->price_usd, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Price (LKR):</strong></td>
                                                <td class="text-success font-weight-bold">Rs
                                                    {{ number_format($tourismItem->price_lkr, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Requires Transport:</strong></td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $tourismItem->requires_transport ? 'warning' : 'secondary' }}">
                                                        {{ $tourismItem->requires_transport ? 'Yes' : 'No' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Created:</strong></td>
                                                <td>{{ $tourismItem->created_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Last Updated:</strong></td>
                                                <td>{{ $tourismItem->updated_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @if ($tourismItem->description)
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5>Description</h5>
                                        <div class="bg-light p-3 rounded">
                                            {{ $tourismItem->description }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($tourismItem->features && count($tourismItem->features) > 0)
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5>Features</h5>
                                        <div class="bg-light p-3 rounded">
                                            @foreach ($tourismItem->features as $feature)
                                                <span class="badge badge-primary mr-2 mb-1">{{ $feature }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($tourismItem->quotations()->exists())
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5>Usage in Quotations</h5>
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i>
                                            This item is currently used in {{ $tourismItem->quotations()->count() }}
                                            quotation(s).
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('admin.tourism-items.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <a href="{{ route('admin.tourism-items.edit', $tourismItem->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Item
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

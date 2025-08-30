@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tourism Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Tourism Items</li>
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

                    <!-- Filter Section -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Filter Options</h3>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.tourism-items.index') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="type">Type:</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="">All Types</option>
                                                <option value="national_park"
                                                    {{ request('type') == 'national_park' ? 'selected' : '' }}>National Park
                                                </option>
                                                <option value="heritage_site"
                                                    {{ request('type') == 'heritage_site' ? 'selected' : '' }}>Heritage Site
                                                </option>
                                                <option value="activity"
                                                    {{ request('type') == 'activity' ? 'selected' : '' }}>Activity</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">All Status</option>
                                                <option value="active"
                                                    {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive"
                                                    {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="search">Search:</label>
                                            <input type="text" name="search" id="search" class="form-control"
                                                value="{{ request('search') }}"
                                                placeholder="Search by name, location, or description...">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    <i class="fas fa-search"></i> Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Tourism Items Table</h3>
                            <div>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#bulkPriceModal">
                                    <i class="fas fa-percentage"></i> Bulk Update Prices
                                </button>
                                <a href="{{ route('admin.tourism-items.export') }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-download"></i> Export CSV
                                </a>
                                <a href="{{ route('admin.tourism-items.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Item
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Location</th>
                                        <th>Price USD</th>
                                        <th>Price LKR</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tourismItems as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <span class="badge badge-secondary">
                                                    {{ $item->getTypeDisplayName() }}
                                                </span>
                                            </td>
                                            <td>{{ $item->location ?? '-' }}</td>
                                            <td>${{ number_format($item->price_usd, 2) }}</td>
                                            <td>Rs {{ number_format($item->price_lkr, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @include('admin.tourism-items.show_modal')
                                                <a href="{{ route('admin.tourism-items.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.tourism-items.destroy', $item->id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        {{ $item->quotations()->exists() ? 'disabled title=Cannot delete item that is used in quotations' : '' }}>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $tourismItems->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bulk Price Update Modal -->
    <div class="modal fade" id="bulkPriceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bulk Update Prices</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tourism-items.bulk-update-prices') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bulk_type">Filter by Type (Optional)</label>
                            <select class="form-control" id="bulk_type" name="type">
                                <option value="">All Types</option>
                                <option value="national_park">National Park</option>
                                <option value="heritage_site">Heritage Site</option>
                                <option value="activity">Activity</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="percentage">Percentage Change <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="percentage" name="percentage" step="0.1"
                                min="-100" max="1000" required
                                placeholder="Enter percentage (e.g., 10 for +10%, -5 for -5%)">
                        </div>
                        <div class="form-group">
                            <label for="currency">Apply to Currency <span class="text-danger">*</span></label>
                            <select class="form-control" id="currency" name="currency" required>
                                <option value="both">Both USD and LKR</option>
                                <option value="usd">USD Only</option>
                                <option value="lkr">LKR Only</option>
                            </select>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            This will update prices for all active items matching the criteria.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Update Prices</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

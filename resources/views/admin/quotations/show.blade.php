@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quotation Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.inquiries') }}">Inquiries</a></li>
                        <li class="breadcrumb-item active">Quotation #{{ $quotation->quotation_number }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @include('admin.common.alert')

            <!-- Action Buttons -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="btn-group">
                        <a href="{{ route('admin.quotations.pdf', $quotation->id) }}" class="btn btn-primary">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>

                    </div>
                </div>
            </div>

            <!-- Quotation Header -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-invoice-dollar"></i>
                        Quotation #{{ $quotation->quotation_number }}
                        <span class="badge badge-{{ $quotation->status == 'sent' ? 'success' : 'warning' }} ml-2">
                            {{ ucfirst($quotation->status) }}
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Client Information</h5>
                            <p><strong>Name:</strong> {{ $quotation->inquiry->first_name }}
                                {{ $quotation->inquiry->last_name }}</p>
                            <p><strong>Email:</strong> {{ $quotation->inquiry->email }}</p>
                            <p><strong>Phone:</strong> {{ $quotation->inquiry->phone }}</p>
                            <p><strong>Group Size:</strong> {{ $quotation->inquiry->group_size }} people</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Quotation Information</h5>
                            <p><strong>Service:</strong> {{ $quotation->inquiry->service->name }}</p>
                            <p><strong>Category:</strong> {{ $quotation->inquiry->service->category->name }}</p>
                            <p><strong>Total Amount:</strong> {{ $quotation->currency }}
                                {{ number_format($quotation->total_amount, 2) }}</p>
                            <p><strong>Valid Until:</strong> {{ $quotation->valid_until->format('Y-m-d') }}</p>
                            <p><strong>Created By:</strong> {{ $quotation->created_by }}</p>
                            <p><strong>Created:</strong> {{ $quotation->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    @if ($quotation->notes)
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5>Notes</h5>
                                <p>{{ $quotation->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Itinerary Days -->
            @if ($quotation->days->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Itinerary</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($quotation->days as $day)
                            <div class="day-detail mb-4 p-3 border rounded">
                                <h5 class="text-primary">Day {{ $day->day_number }}: {{ $day->title }}</h5>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p><strong>Location:</strong> {{ $day->location }}</p>
                                        <p><strong>Description:</strong> {{ $day->description }}</p>
                                        @if ($day->accommodation)
                                            <p><strong>Accommodation:</strong> {{ $day->accommodation }}</p>
                                        @endif
                                        @if ($day->transport)
                                            <p><strong>Transport:</strong> {{ $day->transport }}</p>
                                        @endif
                                        @if (is_array($day->meals_included) && count($day->meals_included) > 0)
                                            <p><strong>Meals Included:</strong> {{ implode(', ', $day->meals_included) }}
                                            </p>
                                        @endif
                                        @if (is_array($day->activities) && count($day->activities) > 0)
                                            <p><strong>Activities:</strong> {{ implode(', ', $day->activities) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-right">
                                            <h6 class="text-success">Cost per Person: {{ $quotation->currency }}
                                                {{ number_format($day->cost_per_person, 2) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


            <!-- Tourism Items -->
            @if ($quotation->tourismItems->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-map-marked-alt"></i> Tourism Items</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($quotation->tourismItems as $tourismItem)
                            <div
                                class="tourism-item-detail mb-3 p-3 border rounded {{ $tourismItem->pivot->is_optional ? 'border-warning' : '' }}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6>{{ $tourismItem->name }}
                                            @if ($tourismItem->pivot->is_optional)
                                                <span class="badge badge-warning">Optional</span>
                                            @endif
                                        </h6>
                                        <p><strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $tourismItem->type)) }}
                                        </p>
                                        @if ($tourismItem->location)
                                            <p><strong>Location:</strong> {{ $tourismItem->location }}</p>
                                        @endif
                                        @if ($tourismItem->description)
                                            <p><strong>Description:</strong> {{ $tourismItem->description }}</p>
                                        @endif
                                        <p><strong>Quantity:</strong> {{ $tourismItem->pivot->quantity }}</p>
                                        @if ($tourismItem->pivot->custom_details)
                                            <p><strong>Special Details:</strong> {{ $tourismItem->pivot->custom_details }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-right">
                                            <p><strong>Unit Price:</strong> {{ $quotation->currency }}
                                                {{ number_format($tourismItem->pivot->unit_price, 2) }}</p>
                                            <h6 class="text-success">Total Price: {{ $quotation->currency }}
                                                {{ number_format($tourismItem->pivot->total_price, 2) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Special Events -->
            @if ($quotation->events->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-star"></i> Special Events</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($quotation->events as $event)
                            <div
                                class="event-detail mb-3 p-3 border rounded {{ $event->is_optional ? 'border-warning' : '' }}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6>{{ $event->event_name }}
                                            @if ($event->is_optional)
                                                <span class="badge badge-warning">Optional</span>
                                            @endif
                                        </h6>
                                        <p><strong>Date:</strong> {{ $event->event_date }}</p>
                                        <p><strong>Location:</strong> {{ $event->location }}</p>
                                        <p><strong>Duration:</strong> {{ $event->duration }}</p>
                                        <p><strong>Description:</strong> {{ $event->description }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-right">
                                            <h6 class="text-success">Cost per Person: {{ $quotation->currency }}
                                                {{ number_format($event->cost_per_person, 2) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Vehicles -->
            @if ($quotation->vehicles->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-car"></i> Vehicles</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($quotation->vehicles as $quotationVehicle)
                            <div class="vehicle-detail mb-3 p-3 border rounded">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6>{{ $quotationVehicle->vehicle->name }}
                                            ({{ $quotationVehicle->vehicle->type }})</h6>
                                        <p><strong>Capacity:</strong> {{ $quotationVehicle->vehicle->capacity }} people</p>
                                        <p><strong>Days Assigned:</strong>
                                            {{ implode(', ', $quotationVehicle->days_assigned) }}</p>
                                        <p><strong>Route:</strong> {{ $quotationVehicle->pickup_location }} →
                                            {{ $quotationVehicle->dropoff_location }}</p>
                                        <p><strong>Estimated Distance:</strong> {{ $quotationVehicle->estimated_km }} KM
                                        </p>
                                        <p><strong>Driver:</strong>
                                            {{ $quotationVehicle->driver_required ? 'Required' : 'Not Required' }}</p>
                                        @if ($quotationVehicle->special_requirements)
                                            <p><strong>Special Requirements:</strong>
                                                {{ $quotationVehicle->special_requirements }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-right">
                                            <p><strong>Cost per Day:</strong> {{ $quotation->currency }}
                                                {{ number_format($quotationVehicle->cost_per_day, 2) }}</p>
                                            <h6 class="text-success">Total Cost: {{ $quotation->currency }}
                                                {{ number_format($quotationVehicle->total_cost, 2) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Cost Summary -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calculator"></i> Cost Summary</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <td><strong>Days Cost:</strong></td>
                                    <td class="text-right">{{ $quotation->currency }}
                                        {{ number_format($quotation->days->sum('cost_per_person') * $quotation->inquiry->group_size, 2) }}
                                    </td>
                                </tr>
                                @if ($quotation->events->count() > 0)
                                    <tr>
                                        <td><strong>Events Cost:</strong></td>
                                        <td class="text-right">{{ $quotation->currency }}
                                            {{ number_format($quotation->events->where('is_optional', false)->sum('cost_per_person') * $quotation->inquiry->group_size, 2) }}
                                        </td>
                                    </tr>
                                @endif
                                @if ($quotation->vehicles->count() > 0)
                                    <tr>
                                        <td><strong>Vehicles Cost:</strong></td>
                                        <td class="text-right">{{ $quotation->currency }}
                                            {{ number_format($quotation->vehicles->sum('total_cost'), 2) }}</td>
                                    </tr>
                                @endif
                                @if ($quotation->tourismItems->count() > 0)
                                    <tr>
                                        <td><strong>Tourism Items Cost:</strong></td>
                                        <td class="text-right">{{ $quotation->currency }}
                                            {{ number_format($quotation->tourismItems->where('pivot.is_optional', false)->sum('pivot.total_price'), 2) }}
                                        </td>
                                    </tr>
                                @endif
                                @if (
                                    $quotation->events->where('is_optional', true)->count() > 0 ||
                                        $quotation->tourismItems->where('pivot.is_optional', true)->count() > 0)
                                    <tr class="text-muted">
                                        <td colspan="2"><small><em>* Optional items are not included in the total
                                                    amount</em></small></td>
                                    </tr>
                                @endif
                                <tr class="table-active">
                                    <td><strong>Total Amount:</strong></td>
                                    <td class="text-right"><strong>{{ $quotation->currency }}
                                            {{ number_format($quotation->total_amount, 2) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="text-right">
                                <h5 class="text-success">Total Cost: {{ $quotation->currency }}
                                    {{ number_format($quotation->total_amount, 2) }}</h5>
                                @if (
                                    $quotation->events->where('is_optional', true)->count() > 0 ||
                                        $quotation->tourismItems->where('pivot.is_optional', true)->count() > 0)
                                    <div class="mt-3 p-2 bg-light border rounded">
                                        <h6 class="text-info">Optional Items Available:</h6>
                                        @if ($quotation->events->where('is_optional', true)->count() > 0)
                                            <p class="small mb-1">
                                                <strong>Optional Events:</strong>
                                                {{ $quotation->currency }}
                                                {{ number_format($quotation->events->where('is_optional', true)->sum('cost_per_person') * $quotation->inquiry->group_size, 2) }}
                                            </p>
                                        @endif
                                        @if ($quotation->tourismItems->where('pivot.is_optional', true)->count() > 0)
                                            <p class="small mb-0">
                                                <strong>Optional Tourism Items:</strong>
                                                {{ $quotation->currency }}
                                                {{ number_format($quotation->tourismItems->where('pivot.is_optional', true)->sum('pivot.total_price'), 2) }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Quotation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.inquiries') }}">Inquiries</a></li>
                        <li class="breadcrumb-item active">Create Quotation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @include('admin.common.alert')

            <form action="{{ route('admin.quotations.store') }}" method="POST" id="quotationForm">
                @csrf
                <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">

                <!-- Inquiry Details Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i> Inquiry Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Client:</strong> {{ $inquiry->first_name }} {{ $inquiry->last_name }}</p>
                                <p><strong>Email:</strong> {{ $inquiry->email }}</p>
                                <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Service:</strong> {{ $inquiry->service->name }}</p>
                                <p><strong>Category:</strong> {{ $inquiry->service->category->name }}</p>
                                <p><strong>Group Size:</strong> {{ $inquiry->group_size }} people</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Quotation Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-file-invoice-dollar"></i> Quotation Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_amount">Total Amount *</label>
                                    <input type="number" class="form-control @error('total_amount') is-invalid @enderror"
                                        id="total_amount" name="total_amount" step="0.01" min="0" required>
                                    @error('total_amount')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="currency">Currency *</label>
                                    <select class="form-control @error('currency') is-invalid @enderror" id="currency"
                                        name="currency" required>
                                        <option value="USD">USD</option>
                                        <option value="LKR" selected>LKR</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                    @error('currency')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="valid_days">Valid Days *</label>
                                    <input type="number" class="form-control @error('valid_days') is-invalid @enderror"
                                        id="valid_days" name="valid_days" min="1" value="30" required>
                                    @error('valid_days')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes"
                                rows="3"></textarea>
                            @error('notes')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Days Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Itinerary Days</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" id="addDay">
                                <i class="fas fa-plus"></i> Add Day
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="daysContainer">
                        <!-- Days will be added dynamically -->
                    </div>
                </div>

                <!-- Events Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-star"></i> Special Events</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-success btn-sm" id="addEvent">
                                <i class="fas fa-plus"></i> Add Event
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="eventsContainer">
                        <!-- Events will be added dynamically -->
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-map-marked-alt"></i> Tourism Items</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-warning btn-sm" id="addTourismItem">
                                <i class="fas fa-plus"></i> Add Tourism Item
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="row">
                                    <!-- National Parks -->
                                    <div class="col-md-4">
                                        <h5>National Parks</h5>
                                        <div class="tourism-category" data-category="national_parks">
                                            @foreach ($nationalParks as $park)
                                                <div class="card border-info mb-2">
                                                    <div class="card-body p-2">
                                                        <h6 class="card-title">{{ $park->name }}</h6>
                                                        <p class="card-text small">
                                                            Type: {{ $park->type }}<br>
                                                            Entry Fee: ${{ $park->price_usd ?? '0.00' }} <br>
                                                            Entry Fee: LKR{{ $park->price_lkr ?? '0.00' }}
                                                        </p>
                                                        <button type="button" class="btn btn-sm btn-info add-tourism-item"
                                                            data-item-id="{{ $park->id }}" data-item-name="{{ $park->name }}"
                                                            data-item-price="{{ $park->price_usd ?? 0 }}">Add This</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Heritage Sites -->
                                    <div class="col-md-4">
                                        <h5>Heritage Sites</h5>
                                        <div class="tourism-category" data-category="heritage_sites">
                                            @foreach ($heritageSites as $site)
                                                <div class="card border-secondary mb-2">
                                                    <div class="card-body p-2">
                                                        <h6 class="card-title">{{ $site->name }}</h6>
                                                        <p class="card-text small">
                                                            Type: {{ $site->type }}<br>
                                                            Entry Fee: ${{ $site->price_usd ?? '0.00' }} <br>
                                                            Entry Fee: LKR{{ $site->price_lkr ?? '0.00' }}
                                                        </p>
                                                        <button type="button" class="btn btn-sm btn-secondary add-tourism-item"
                                                            data-item-id="{{ $site->id }}" data-item-name="{{ $site->name }}"
                                                            data-item-price="{{ $site->price_usd ?? 0 }}">Add This</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Activities -->
                                    <div class="col-md-4">
                                        <h5>Activities</h5>
                                        <div class="tourism-category" data-category="activities">
                                            @foreach ($activities as $activity)
                                                <div class="card border-success mb-2">
                                                    <div class="card-body p-2">
                                                        <h6 class="card-title">{{ $activity->name }}</h6>
                                                        <p class="card-text small">
                                                            Type: {{ $activity->type }}<br>
                                                            Cost: ${{ $activity->price_usd ?? '0.00' }} <br>
                                                            Cost: LKR{{ $activity->price_lkr ?? '0.00' }}
                                                        </p>
                                                        <button type="button" class="btn btn-sm btn-success add-tourism-item"
                                                            data-item-id="{{ $activity->id }}"
                                                            data-item-name="{{ $activity->name }}"
                                                            data-item-price="{{ $activity->price_usd ?? 0 }}">Add
                                                            This</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tourismItemsContainer">
                            <!-- Tourism items will be added dynamically -->
                        </div>
                    </div>
                </div>

                <!-- Vehicles Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-car"></i> Vehicles</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-info btn-sm" id="addVehicle">
                                <i class="fas fa-plus"></i> Add Vehicle
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5>Suggested Vehicles for {{ $inquiry->group_size }} people:</h5>
                                <div class="row">
                                    @foreach ($suggestedVehicles as $vehicle)
                                        <div class="col-md-4 mb-2">
                                            <div class="card border-success">
                                                <div class="card-body p-2">
                                                    <h6 class="card-title">{{ $vehicle->name }}</h6>
                                                    <p class="card-text small">
                                                        Capacity: {{ $vehicle->capacity }}<br>
                                                        Cost/Day: {{ $vehicle->cost_per_day }}<br>
                                                        Cost/KM: {{ $vehicle->cost_per_km }}
                                                    </p>
                                                    <button type="button" class="btn btn-sm btn-success use-vehicle"
                                                        data-vehicle-id="{{ $vehicle->id }}">Use This</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="vehiclesContainer">
                            <!-- Vehicles will be added dynamically -->
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="card">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save"></i> Create Quotation
                        </button>
                        <a href="{{ route('admin.inquiries') }}" class="btn btn-secondary btn-lg ml-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let dayCount = 0;
        let eventCount = 0;
        let vehicleCount = 0;

        // Add initial day
        $(document).ready(function () {
            addDay();
        });

        // Add Day functionality
        $('#addDay').click(function () {
            addDay();
        });

        function addDay() {
            dayCount++;
            const dayHtml = `
                    <div class="day-item border p-3 mb-3" data-day="${dayCount}">
                        <div class="row">
                            <div class="col-md-10">
                                <h5>Day ${dayCount}</h5>
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="button" class="btn btn-danger btn-sm remove-day">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title *</label>
                                    <input type="text" class="form-control" name="days[${dayCount - 1}][title]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location *</label>
                                    <input type="text" class="form-control" name="days[${dayCount - 1}][location]" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description *</label>
                            <textarea class="form-control" name="days[${dayCount - 1}][description]" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Accommodation</label>
                                    <input type="text" class="form-control" name="days[${dayCount - 1}][accommodation]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Transport</label>
                                    <input type="text" class="form-control" name="days[${dayCount - 1}][transport]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cost per Person *</label>
                                    <input type="number" class="form-control" name="days[${dayCount - 1}][cost_per_person]" step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meals Included</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][meals_included][]" value="breakfast"> Breakfast
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][meals_included][]" value="lunch"> Lunch
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][meals_included][]" value="dinner"> Dinner
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Activities</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="hiking"> Hiking
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="sightseeing"> Sightseeing
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="cultural_tour"> Cultural Tour
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="wildlife_safari"> Wildlife Safari
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="beach_activities"> Beach Activities
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="adventure_sports"> Adventure Sports
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="photography"> Photography
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="days[${dayCount - 1}][activities][]" value="shopping"> Shopping
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input type="text" class="form-control form-control-sm" name="days[${dayCount - 1}][activities][]" placeholder="Add custom activity">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            $('#daysContainer').append(dayHtml);
        }

        // Remove Day
        $(document).on('click', '.remove-day', function () {
            $(this).closest('.day-item').remove();
        });

        // Add Event functionality
        $('#addEvent').click(function () {
            addEvent();
        });

        function addEvent() {
            const eventHtml = `
                    <div class="event-item border p-3 mb-3" data-event="${eventCount}">
                        <div class="row">
                            <div class="col-md-10">
                                <h5>Event ${eventCount + 1}</h5>
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="button" class="btn btn-danger btn-sm remove-event">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Event Name *</label>
                                    <input type="text" class="form-control" name="events[${eventCount}][event_name]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Event Date *</label>
                                    <input type="date" class="form-control" name="events[${eventCount}][event_date]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location *</label>
                                    <input type="text" class="form-control" name="events[${eventCount}][location]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration *</label>
                                    <input type="text" class="form-control" name="events[${eventCount}][duration]" placeholder="e.g., 2 hours" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description *</label>
                            <textarea class="form-control" name="events[${eventCount}][description]" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cost per Person *</label>
                                    <input type="number" class="form-control" name="events[${eventCount}][cost_per_person]" step="0.01" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="events[${eventCount}][is_optional]" value="1"> Optional Event
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            $('#eventsContainer').append(eventHtml);
            eventCount++;
        }

        // Remove Event
        $(document).on('click', '.remove-event', function () {
            $(this).closest('.event-item').remove();
        });

        // Add Vehicle functionality
        $('#addVehicle').click(function () {
            addVehicle();
        });

        function addVehicle(vehicleId = null) {
            const vehicleHtml = `
                    <div class="vehicle-item border p-3 mb-3" data-vehicle="${vehicleCount}">
                        <div class="row">
                            <div class="col-md-10">
                                <h5>Vehicle ${vehicleCount + 1}</h5>
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="button" class="btn btn-danger btn-sm remove-vehicle">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vehicle *</label>
                                    <select class="form-control" name="vehicles[${vehicleCount}][vehicle_id]" required>
                                        <option value="">Select Vehicle</option>
                                        @foreach ($allVehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" ${vehicleId == {{ $vehicle->id }} ? 'selected' : ''}>
                                                {{ $vehicle->name }} ({{ $vehicle->type }}) - Capacity: {{ $vehicle->capacity }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Days Assigned *</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="1"> Day 1
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="2"> Day 2
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="3"> Day 3
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="4"> Day 4
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="5"> Day 5
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="6"> Day 6
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="7"> Day 7
                                            </label>
                                            <label class="d-block">
                                                <input type="checkbox" name="vehicles[${vehicleCount}][days_assigned][]" value="8"> Day 8
                                            </label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Select the days this vehicle will be used</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pickup Location *</label>
                                    <input type="text" class="form-control" name="vehicles[${vehicleCount}][pickup_location]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dropoff Location *</label>
                                    <input type="text" class="form-control" name="vehicles[${vehicleCount}][dropoff_location]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estimated KM *</label>
                                    <input type="number" class="form-control" name="vehicles[${vehicleCount}][estimated_km]" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Driver Options</label>
                                    <label>
                                        <input type="checkbox" name="vehicles[${vehicleCount}][driver_required]" value="1" checked> Driver Required
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Special Requirements</label>
                            <textarea class="form-control" name="vehicles[${vehicleCount}][special_requirements]" rows="2"></textarea>
                        </div>
                    </div>
                `;
            $('#vehiclesContainer').append(vehicleHtml);
            vehicleCount++;
        }

        // Use suggested vehicle
        $(document).on('click', '.use-vehicle', function () {
            const vehicleId = $(this).data('vehicle-id');
            addVehicle(vehicleId);
        });

        // Remove Vehicle
        $(document).on('click', '.remove-vehicle', function () {
            $(this).closest('.vehicle-item').remove();
        });

        let tourismItemCount = 0;

        // Add Tourism Item functionality
        $('#addTourismItem').click(function () {
            addTourismItem();
        });

        function addTourismItem(itemId = null, itemName = '', unitPrice = 0) {
            const tourismItemHtml = `
            <div class="tourism-item border p-3 mb-3" data-tourism-item="${tourismItemCount}">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Tourism Item ${tourismItemCount + 1}</h5>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="button" class="btn btn-danger btn-sm remove-tourism-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tourism Item *</label>
                            <select class="form-control" name="tourism_items[${tourismItemCount}][tourism_item_id]" required>
                                <option value="">Select Tourism Item</option>
                                @foreach($allTourismItems as $item)
                                    <option value="{{ $item->id }}" ${itemId == '{{ $item->id }}' ? 'selected' : ''}>
                                        {{ $item->name }} ({{ $item->type }}) - ${{ $item->price_usd ?? '0.00' }} | LKR ${{ $item->price_lkr ?? '0.00' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantity *</label>
                            <input type="number" class="form-control" name="tourism_items[${tourismItemCount}][quantity]" min="1" value="1" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Custom Details</label>
                    <textarea class="form-control" name="tourism_items[${tourismItemCount}][custom_details]" rows="2" placeholder="Any special requirements or notes for this item..."></textarea>
                </div>
            </div>
        `;
            $('#tourismItemsContainer').append(tourismItemHtml);

            // Auto-calculate total price when quantity or unit price changes
            $(`[name="tourism_items[${tourismItemCount}][quantity]"], [name="tourism_items[${tourismItemCount}][unit_price]"]`).on('input', function () {
                const container = $(this).closest('.tourism-item');
                const quantity = parseFloat(container.find('[name*="[quantity]"]').val()) || 0;
                const unitPrice = parseFloat(container.find('[name*="[unit_price]"]').val()) || 0;
                const totalPrice = quantity * unitPrice;
                container.find('[name*="[total_price]"]').val(totalPrice.toFixed(2));
            });

            tourismItemCount++;
        }

        // Add suggested tourism item
        $(document).on('click', '.add-tourism-item', function () {
            const itemId = $(this).data('item-id');
            const itemName = $(this).data('item-name');
            const unitPrice = $(this).data('item-price');
            addTourismItem(itemId, itemName, unitPrice);
        });

        // Remove Tourism Item
        $(document).on('click', '.remove-tourism-item', function () {
            $(this).closest('.tourism-item').remove();
        });
    </script>
@endsection

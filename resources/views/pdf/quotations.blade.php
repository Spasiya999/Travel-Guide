<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Quotation - {{ $quotation->quotation_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            border-bottom: 3px solid #2c5aa0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-info {
            display: table;
            width: 100%;
        }

        .company-info .left,
        .company-info .right {
            display: table-cell;
            vertical-align: top;
        }

        .company-info .left {
            width: 60%;
        }

        .company-info .right {
            width: 40%;
            text-align: right;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 5px;
        }

        .company-tagline {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .company-details {
            font-size: 11px;
            color: #666;
        }

        .quotation-title {
            font-size: 20px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 5px;
        }

        .quotation-number {
            font-size: 14px;
            color: #666;
        }

        /* Client Info Styles */
        .client-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c5aa0;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .client-info {
            display: table;
            width: 100%;
        }

        .client-info .left,
        .client-info .right {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            width: 120px;
            display: inline-block;
        }

        .info-value {
            color: #333;
        }

        /* Quotation Details */
        .quotation-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .details-grid {
            display: table;
            width: 100%;
        }

        .details-col {
            display: table-cell;
            width: 33.33%;
            padding-right: 15px;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
            font-size: 11px;
        }

        .detail-value {
            font-size: 14px;
            color: #333;
            font-weight: bold;
        }

        /* Itinerary Styles */
        .itinerary-section {
            margin-bottom: 30px;
        }

        .day-item {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .day-header {
            background-color: #2c5aa0;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 14px;
        }

        .day-content {
            padding: 15px;
        }

        .day-info {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .day-info .left,
        .day-info .right {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .day-description {
            margin-bottom: 15px;
            color: #555;
            line-height: 1.5;
        }

        .activities-meals {
            display: table;
            width: 100%;
        }

        .activities,
        .meals {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .activities {
            padding-right: 15px;
        }

        .activities ul,
        .meals ul {
            list-style: none;
            padding: 0;
        }

        .activities li,
        .meals li {
            background-color: #f8f9fa;
            padding: 5px 10px;
            margin-bottom: 3px;
            border-radius: 3px;
            font-size: 11px;
        }

        .cost-highlight {
            background-color: #e8f5e8;
            padding: 8px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: #2c5aa0;
        }

        /* Events Section */
        .events-section {
            margin-bottom: 30px;
        }

        .event-item {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .event-header {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
        }

        .event-content {
            padding: 15px;
        }

        .event-details {
            display: table;
            width: 100%;
        }

        .event-details .left,
        .event-details .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .optional-badge {
            background-color: #ffc107;
            color: #000;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }

        /* Vehicles Section */
        .vehicles-section {
            margin-bottom: 30px;
        }

        .vehicle-item {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .vehicle-header {
            background-color: #17a2b8;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
        }

        .vehicle-content {
            padding: 15px;
        }

        .vehicle-details {
            display: table;
            width: 100%;
        }

        .vehicle-details .left,
        .vehicle-details .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .days-assigned {
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 3px;
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 3px;
            font-size: 11px;
        }

        /* Cost Summary */
        .cost-summary {
            background-color: #f8f9fa;
            border: 2px solid #2c5aa0;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .cost-summary-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c5aa0;
            text-align: center;
            margin-bottom: 20px;
        }

        .cost-breakdown {
            margin-bottom: 15px;
        }

        .cost-row {
            display: table;
            width: 100%;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .cost-row:last-child {
            border-bottom: none;
        }

        .cost-label {
            display: table-cell;
            font-weight: bold;
            color: #555;
        }

        .cost-value {
            display: table-cell;
            text-align: right;
            font-weight: bold;
            color: #333;
        }

        .total-row {
            background-color: #2c5aa0;
            color: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 3px;
        }

        .total-row .cost-label,
        .total-row .cost-value {
            color: white;
            font-size: 16px;
        }

        /* Terms and Conditions */
        .terms-section {
            margin-bottom: 30px;
        }

        .terms-content {
            font-size: 11px;
            line-height: 1.5;
            color: #555;
        }

        .terms-content ul {
            padding-left: 20px;
        }

        .terms-content li {
            margin-bottom: 5px;
        }

        /* Footer */
        .footer {
            border-top: 2px solid #2c5aa0;
            padding-top: 15px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }

        .footer-contact {
            margin-bottom: 10px;
        }

        .footer-note {
            font-style: italic;
        }

        /* Page Break */
        .page-break {
            page-break-before: always;
        }

        /* Print Styles */
        @media print {
            body {
                font-size: 11px;
            }

            .container {
                padding: 10px;
            }
        }

        .tourism-items-section {
            margin-bottom: 30px;
        }

        .tourism-item {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .tourism-header {
            background-color: #ff6b35;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
        }

        .tourism-content {
            padding: 15px;
        }

        .tourism-details {
            display: table;
            width: 100%;
        }

        .tourism-details .left,
        .tourism-details .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <div class="left">
                    <div class="company-name">TravelGuide Lanka</div>
                    <div class="company-tagline">Your Gateway to Sri Lankan Adventures</div>
                    <div class="company-details">
                        123 Galle Road, Colombo 03, Sri Lanka<br>
                        Tel: +94 11 123 4567 | Email: info@travelguide.lk<br>
                        Web: www.travelguide.lk
                    </div>
                </div>
                <div class="right">
                    <div class="quotation-title">QUOTATION</div>
                    <div class="quotation-number">{{ $quotation->quotation_number }}</div>
                </div>
            </div>
        </div>

        <!-- Client Information -->
        <div class="client-section">
            <div class="section-title">Client Information</div>
            <div class="client-info">
                <div class="left">
                    <div class="info-row">
                        <span class="info-label">Client Name:</span>
                        <span class="info-value">{{ $quotation->inquiry->first_name }}
                            {{ $quotation->inquiry->last_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $quotation->inquiry->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $quotation->inquiry->phone }}</span>
                    </div>
                </div>
                <div class="right">
                    <div class="info-row">
                        <span class="info-label">Service:</span>
                        <span class="info-value">{{ $quotation->inquiry->service->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Group Size:</span>
                        <span class="info-value">{{ $quotation->inquiry->group_size }} people</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Quotation Date:</span>
                        <span class="info-value">{{ $quotation->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quotation Details -->
        <div class="quotation-details">
            <div class="details-grid">
                <div class="details-col">
                    <div class="detail-item">
                        <div class="detail-label">TOTAL AMOUNT</div>
                        <div class="detail-value">{{ strtoupper($quotation->currency) }}
                            {{ number_format($quotation->total_amount, 2) }}
                        </div>
                    </div>
                </div>
                <div class="details-col">
                    <div class="detail-item">
                        <div class="detail-label">VALID UNTIL</div>
                        <div class="detail-value">
                            {{ \Carbon\Carbon::parse($quotation->valid_until)->format('F d, Y') }}
                        </div>
                    </div>
                </div>
                <div class="details-col">
                    <div class="detail-item">
                        <div class="detail-label">CREATED BY</div>
                        <div class="detail-value">{{ $quotation->created_by }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Itinerary -->
        <div class="itinerary-section">
            <div class="section-title">Detailed Itinerary</div>
            @foreach ($quotation->days as $day)
                <div class="day-item">
                    <div class="day-header">
                        Day {{ $day->day_number }}: {{ $day->title }}
                    </div>
                    <div class="day-content">
                        <div class="day-info">
                            <div class="left">
                                <div class="info-row">
                                    <span class="info-label">Location:</span>
                                    <span class="info-value">{{ $day->location }}</span>
                                </div>
                                @if ($day->accommodation)
                                    <div class="info-row">
                                        <span class="info-label">Accommodation:</span>
                                        <span class="info-value">{{ $day->accommodation }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="right">
                                @if ($day->transport)
                                    <div class="info-row">
                                        <span class="info-label">Transport:</span>
                                        <span class="info-value">{{ $day->transport }}</span>
                                    </div>
                                @endif
                                <div class="cost-highlight">
                                    {{ strtoupper($quotation->currency) }}
                                    {{ number_format($day->cost_per_person, 2) }} per
                                    person
                                </div>
                            </div>
                        </div>

                        <div class="day-description">
                            {{ $day->description }}
                        </div>

                        <div class="activities-meals">
                            @if (!empty($day->activities))
                                <div class="activities">
                                    <strong>Activities:</strong>
                                    <ul>
                                        @foreach ($day->activities as $activity)
                                            <li>{{ $activity }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($day->meals_included))
                                <div class="meals">
                                    <strong>Meals Included:</strong>
                                    <ul>
                                        @foreach ($day->meals_included as $meal)
                                            <li>{{ ucfirst($meal) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($quotation->tourismItems->count() > 0)
            <!-- Tourism Items -->
            <div class="tourism-items-section">
                <div class="section-title">Tourism Items & Attractions</div>
                @foreach ($quotation->tourismItems as $tourismItem)
                    <div class="tourism-item">
                        <div class="tourism-header">
                            {{ $tourismItem->name }}
                            @if ($tourismItem->pivot->is_optional)
                                <span class="optional-badge">OPTIONAL</span>
                            @endif
                        </div>
                        <div class="tourism-content">
                            <div class="tourism-details">
                                <div class="left">
                                    <div class="info-row">
                                        <span class="info-label">Type:</span>
                                        <span
                                            class="info-value">{{ ucfirst(str_replace('_', ' ', $tourismItem->type)) }}</span>
                                    </div>
                                    @if ($tourismItem->location)
                                        <div class="info-row">
                                            <span class="info-label">Location:</span>
                                            <span class="info-value">{{ $tourismItem->location }}</span>
                                        </div>
                                    @endif
                                    <div class="info-row">
                                        <span class="info-label">Quantity:</span>
                                        <span class="info-value">{{ $tourismItem->pivot->quantity }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Unit Price:</span>
                                        <span class="info-value">{{ strtoupper($quotation->currency) }}
                                            {{ number_format($tourismItem->pivot->unit_price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="cost-highlight">
                                        {{ strtoupper($quotation->currency) }}
                                        {{ number_format($tourismItem->pivot->total_price, 2) }}
                                        @if ($tourismItem->pivot->is_optional)
                                            <div style="font-size: 10px; margin-top: 3px;">(Optional)</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($tourismItem->description)
                                <div class="day-description">
                                    {{ $tourismItem->description }}
                                </div>
                            @endif
                            @if ($tourismItem->pivot->custom_details)
                                <div class="day-description">
                                    <strong>Special Requirements:</strong> {{ $tourismItem->pivot->custom_details }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($quotation->events->count() > 0)
            <!-- Special Events -->
            <div class="events-section">
                <div class="section-title">Special Events</div>
                @foreach ($quotation->events as $event)
                    <div class="event-item">
                        <div class="event-header">
                            {{ $event->event_name }}
                            @if ($event->is_optional)
                                <span class="optional-badge">OPTIONAL</span>
                            @endif
                        </div>
                        <div class="event-content">
                            <div class="event-details">
                                <div class="left">
                                    <div class="info-row">
                                        <span class="info-label">Date:</span>
                                        <span
                                            class="info-value">{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Location:</span>
                                        <span class="info-value">{{ $event->location }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Duration:</span>
                                        <span class="info-value">{{ $event->duration }}</span>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="cost-highlight">
                                        {{ strtoupper($quotation->currency) }}
                                        {{ number_format($event->cost_per_person, 2) }}
                                        per person
                                    </div>
                                </div>
                            </div>
                            <div class="day-description">
                                {{ $event->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($quotation->vehicles->count() > 0)
            <!-- Vehicles -->
            <div class="vehicles-section">
                <div class="section-title">Transportation</div>
                @foreach ($quotation->vehicles as $quotationVehicle)
                    <div class="vehicle-item">
                        <div class="vehicle-header">
                            {{ $quotationVehicle->vehicle->name }} ({{ $quotationVehicle->vehicle->type }})
                        </div>
                        <div class="vehicle-content">
                            <div class="vehicle-details">
                                <div class="left">
                                    <div class="info-row">
                                        <span class="info-label">Capacity:</span>
                                        <span class="info-value">{{ $quotationVehicle->vehicle->capacity }}
                                            passengers</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Pickup:</span>
                                        <span class="info-value">{{ $quotationVehicle->pickup_location }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Drop-off:</span>
                                        <span class="info-value">{{ $quotationVehicle->dropoff_location }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Distance:</span>
                                        <span class="info-value">{{ $quotationVehicle->estimated_km }} km</span>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="info-row">
                                        <span class="info-label">Days Assigned:</span>
                                        <div>
                                            @foreach ($quotationVehicle->days_assigned as $day)
                                                <span class="days-assigned">Day {{ $day }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Driver:</span>
                                        <span
                                            class="info-value">{{ $quotationVehicle->driver_required ? 'Included' : 'Not Required' }}</span>
                                    </div>
                                    <div class="cost-highlight">
                                        {{ strtoupper($quotation->currency) }}
                                        {{ number_format($quotationVehicle->total_cost, 2) }}
                                    </div>
                                </div>
                            </div>
                            @if ($quotationVehicle->special_requirements)
                                <div class="day-description">
                                    <strong>Special Requirements:</strong>
                                    {{ $quotationVehicle->special_requirements }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Cost Summary -->
        <div class="cost-summary">
            <div class="cost-summary-title">Cost Summary</div>
            <div class="cost-breakdown">
                @php
                    $daysCost = $quotation->days->sum('cost_per_person') * $quotation->inquiry->group_size;
                    $eventsCost =
                        $quotation->events->where('is_optional', false)->sum('cost_per_person') *
                        $quotation->inquiry->group_size;
                    $vehiclesCost = $quotation->vehicles->sum('total_cost');
                    $tourismItemsCost = $quotation->tourismItems
                        ->where('pivot.is_optional', false)
                        ->sum('pivot.total_price');

                    // Optional items
                    $optionalEventsCost =
                        $quotation->events->where('is_optional', true)->sum('cost_per_person') *
                        $quotation->inquiry->group_size;
                    $optionalTourismItemsCost = $quotation->tourismItems
                        ->where('pivot.is_optional', true)
                        ->sum('pivot.total_price');
                @endphp

                <div class="cost-row">
                    <div class="cost-label">Itinerary Days ({{ $quotation->inquiry->group_size }} people)</div>
                    <div class="cost-value">{{ strtoupper($quotation->currency) }} {{ number_format($daysCost, 2) }}
                    </div>
                </div>

                @if ($eventsCost > 0)
                    <div class="cost-row">
                        <div class="cost-label">Special Events ({{ $quotation->inquiry->group_size }} people)</div>
                        <div class="cost-value">{{ strtoupper($quotation->currency) }}
                            {{ number_format($eventsCost, 2) }}
                        </div>
                    </div>
                @endif

                @if ($vehiclesCost > 0)
                    <div class="cost-row">
                        <div class="cost-label">Transportation</div>
                        <div class="cost-value">{{ strtoupper($quotation->currency) }}
                            {{ number_format($vehiclesCost, 2) }}
                        </div>
                    </div>
                @endif

                @if ($tourismItemsCost > 0)
                    <div class="cost-row">
                        <div class="cost-label">Tourism Items & Attractions</div>
                        <div class="cost-value">{{ strtoupper($quotation->currency) }}
                            {{ number_format($tourismItemsCost, 2) }}</div>
                    </div>
                @endif
            </div>

            <div class="total-row">
                <div class="cost-row">
                    <div class="cost-label">TOTAL AMOUNT</div>
                    <div class="cost-value">{{ strtoupper($quotation->currency) }}
                        {{ number_format($quotation->total_amount, 2) }}</div>
                </div>
            </div>

            @if ($optionalEventsCost > 0 || $optionalTourismItemsCost > 0)
                <div style="margin-top: 15px; padding: 10px; background-color: #fff3cd; border-radius: 3px;">
                    <div style="font-weight: bold; font-size: 14px; color: #856404; margin-bottom: 5px;">Optional Items
                        Available:</div>
                    @if ($optionalEventsCost > 0)
                        <div class="cost-row" style="border-bottom: none; padding: 3px 0;">
                            <div class="cost-label" style="color: #856404;">Optional Events:</div>
                            <div class="cost-value" style="color: #856404;">{{ strtoupper($quotation->currency) }}
                                {{ number_format($optionalEventsCost, 2) }}</div>
                        </div>
                    @endif
                    @if ($optionalTourismItemsCost > 0)
                        <div class="cost-row" style="border-bottom: none; padding: 3px 0;">
                            <div class="cost-label" style="color: #856404;">Optional Tourism Items:</div>
                            <div class="cost-value" style="color: #856404;">{{ strtoupper($quotation->currency) }}
                                {{ number_format($optionalTourismItemsCost, 2) }}</div>
                        </div>
                    @endif
                    <div style="font-size: 11px; color: #856404; margin-top: 8px; text-align: center;">
                        <em>* Optional items are not included in the total amount above</em>
                    </div>
                </div>
            @endif
        </div>

        @if ($quotation->notes)
            <!-- Notes -->
            <div class="client-section">
                <div class="section-title">Additional Notes</div>
                <div class="day-description">
                    {{ $quotation->notes }}
                </div>
            </div>
        @endif

        <!-- Terms and Conditions -->
        <div class="terms-section">
            <div class="section-title">Terms and Conditions</div>
            <div class="terms-content">
                <ul>
                    <li>This quotation is valid until
                        {{ \Carbon\Carbon::parse($quotation->valid_until)->format('F d, Y') }}.
                    </li>
                    <li>A 50% deposit is required to confirm the booking.</li>
                    <li>Final payment must be made 7 days before the tour start date.</li>
                    <li>Cancellation charges apply as per our cancellation policy.</li>
                    <li>Prices are subject to change due to currency fluctuations and fuel price variations.</li>
                    <li>All entrance fees, permits, and taxes are included unless otherwise specified.</li>
                    <li>Travel insurance is recommended and not included in the package.</li>
                    <li>Weather conditions may affect certain activities and alternative arrangements will be made.</li>
                    <li>The company reserves the right to modify the itinerary due to unforeseen circumstances.</li>
                    <li>All rates are quoted in {{ strtoupper($quotation->currency) }} and are per person unless
                        otherwise stated.</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-contact">
                <strong>Contact Us:</strong> +94 11 123 4567 | info@travelguide.lk | www.travelguide.lk
            </div>
            <div class="footer-note">
                Thank you for choosing TravelGuide Lanka. We look forward to creating unforgettable memories for you!
            </div>
        </div>
    </div>
</body>

</html>

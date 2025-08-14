<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationVehicle extends Model
{
    protected $table = 'quotation_vehicles';

    protected $fillable = [
        'quotation_id',
        'vehicle_id',
        'days_assigned',
        'pickup_location',
        'dropoff_location',
        'estimated_km',
        'driver_required',
        'special_requirements',
        'cost_per_day',
        'total_cost',
        'notes',
    ];

    protected $casts = [
        'days_assigned' => 'array',
        'driver_required' => 'boolean',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function calculateTotalCost()
    {
        $daysCost = count($this->days_assigned) * $this->cost_per_day;
        $kmCost = $this->estimated_km * $this->vehicle->cost_per_km;

        return $daysCost + $kmCost;
    }
}

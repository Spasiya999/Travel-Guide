<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'name',
        'type', // car, van, bus, coach, etc.
        'capacity',
        'description',
        'features',
        'cost_per_day',
        'cost_per_km',
        'fuel_type',
        'ac_available',
        'driver_included',
        'image',
        'status', // active, inactive
    ];

    protected $casts = [
        'features' => 'array',
        'ac_available' => 'boolean',
        'driver_included' => 'boolean',
    ];

    public function quotationVehicles()
    {
        return $this->hasMany(QuotationVehicle::class);
    }

    // Method to suggest vehicles based on group size
    public static function suggestForGroupSize($groupSize)
    {
        if ($groupSize <= 3) {
            return self::where('type', 'car')->where('capacity', '>=', $groupSize)->where('status', 'active')->get();
        } elseif ($groupSize <= 8) {
            return self::where('type', 'van')->where('capacity', '>=', $groupSize)->where('status', 'active')->get();
        } elseif ($groupSize <= 15) {
            return self::where('type', 'minibus')->where('capacity', '>=', $groupSize)->where('status', 'active')->get();
        } else {
            return self::where('type', 'bus')->where('capacity', '>=', $groupSize)->where('status', 'active')->get();
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'location',
        'price_usd',
        'price_lkr',
        'features',
        'requires_transport',
        'duration',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'price_usd' => 'decimal:2',
        'price_lkr' => 'decimal:2',
        'requires_transport' => 'boolean'
    ];

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class, 'quotation_tourism_items')
                    ->withPivot('quantity', 'unit_price', 'total_price', 'custom_details', 'is_optional')
                    ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeNationalParks($query)
    {
        return $query->where('type', 'national_park');
    }

    public function scopeHeritageSites($query)
    {
        return $query->where('type', 'heritage_site');
    }

    public function scopeActivities($query)
    {
        return $query->where('type', 'activity');
    }

    public function getPriceInCurrency($currency)
    {
        return match(strtoupper($currency)) {
            'USD' => $this->price_usd,
            'LKR' => $this->price_lkr,
            default => $this->price_lkr
        };
    }

    public function getTypeDisplayName()
    {
        return match($this->type) {
            'national_park' => 'National Park',
            'heritage_site' => 'Heritage Site',
            'activity' => 'Activity',
            default => ucfirst($this->type)
        };
    }
}

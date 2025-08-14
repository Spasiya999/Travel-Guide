<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotations';

    protected $fillable = [
        'inquiry_id',
        'quotation_number',
        'total_amount',
        'currency',
        'valid_until',
        'notes',
        'status', // draft, sent, accepted, rejected
        'created_by',
    ];

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function days()
    {
        return $this->hasMany(QuotationDay::class)->orderBy('day_number');
    }

    public function events()
    {
        return $this->hasMany(QuotationEvent::class);
    }

    public function vehicles()
    {
        return $this->hasMany(QuotationVehicle::class);
    }

    public function tourismItems()
    {
        return $this->belongsToMany(TourismItem::class, 'quotation_tourism_items')
            ->withPivot('quantity', 'unit_price', 'total_price', 'custom_details', 'is_optional')
            ->withTimestamps();
    }

    public function generateQuotationNumber()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->format('m');
        $lastQuotation = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'desc')
            ->first();

        $sequence = $lastQuotation ? (int)substr($lastQuotation->quotation_number, -4) + 1 : 1;
        return 'QUO-' . $year . $month . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function calculateTourismItemsTotal()
    {
        return $this->tourismItems()->sum('quotation_tourism_items.total_price');
    }

    public function calculateDaysTotal()
    {
        $groupSize = $this->inquiry->group_size ?? 1;
        return $this->days()->sum('cost_per_person') * $groupSize;
    }

    public function calculateEventsTotal()
    {
        $groupSize = $this->inquiry->group_size ?? 1;
        return $this->events()->where('is_optional', false)->sum('cost_per_person') * $groupSize;
    }

    public function calculateVehiclesTotal()
    {
        return $this->vehicles()->sum('total_cost');
    }

    public function calculateGrandTotal()
    {
        return $this->calculateDaysTotal() +
            $this->calculateEventsTotal() +
            $this->calculateVehiclesTotal() +
            $this->calculateTourismItemsTotal();
    }

    // Update total amount
    public function updateTotalAmount()
    {
        $this->tourism_items_total = $this->calculateTourismItemsTotal();
        $this->total_amount = $this->calculateGrandTotal();
        $this->save();
    }
}

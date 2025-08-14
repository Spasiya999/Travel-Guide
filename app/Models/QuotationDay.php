<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationDay extends Model
{
    protected $table = 'quotation_days';

    protected $fillable = [
        'quotation_id',
        'day_number',
        'title',
        'description',
        'location',
        'accommodation',
        'meals_included',
        'activities',
        'transport',
        'cost_per_person',
    ];

    protected $casts = [
        'meals_included' => 'array',
        'activities' => 'array',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}

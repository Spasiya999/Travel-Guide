<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationEvent extends Model
{
    protected $table = 'quotation_events';

    protected $fillable = [
        'quotation_id',
        'event_name',
        'event_date',
        'location',
        'description',
        'duration',
        'cost_per_person',
        'is_optional',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'is_optional' => 'boolean',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}

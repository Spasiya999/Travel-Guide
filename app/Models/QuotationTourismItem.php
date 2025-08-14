<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class QuotationTourismItem extends Pivot
{
    protected $table = 'quotation_tourism_items';

    protected $fillable = [
        'quotation_id',
        'tourism_item_id',
        'quantity',
        'unit_price',
        'total_price',
        'custom_details',
        'is_optional'
    ];

    protected $casts = [
        'custom_details' => 'array',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'is_optional' => 'boolean'
    ];

    public $timestamps = true;

    // Relationships
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function tourismItem()
    {
        return $this->belongsTo(TourismItem::class);
    }
}

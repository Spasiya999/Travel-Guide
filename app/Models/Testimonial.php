<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'message',
        'country',
        'date',
        'rating',
        'image',
        'user_image',
        'is_approved',
        'service_id',
        'category_id',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'date',
        'group_size',
        'message',
        'service_id',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'quotation_vehicles')
            ->withPivot(['days_assigned', 'pickup_location', 'dropoff_location', 'total_cost'])
            ->withTimestamps();
    }
}

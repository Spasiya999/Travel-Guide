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
}

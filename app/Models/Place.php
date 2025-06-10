<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'image',
        'status',
        'is_popular'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}

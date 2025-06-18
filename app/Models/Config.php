<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';

    protected $fillable = [
        'name',
        'value',
        'status'
    ];

    public static function getValue($name, $default = null)
    {
        $config = self::where('name', $name)->where('status', 1)->first();
        return $config ? $config->value : $default;
    }
}

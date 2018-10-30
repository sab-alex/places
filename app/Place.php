<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];

    protected $guarded = ['id'];
}

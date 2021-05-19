<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleFeatures extends Model
{
    protected $fillable = [
        'vehicle_id',
        'feature_id',
    ];
}

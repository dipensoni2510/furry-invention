<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    protected $fillable = [
      'user_id',
      'vehicle_id'
    ];
}

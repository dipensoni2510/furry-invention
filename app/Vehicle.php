<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name',
    'company_id',
    'model',
    'vehicle_type',
    'wheels',
    'gear_type',
    'specifications',
    'price',
    'number',
    'image'
  ];

  public function getImageAttribute($value)
  {
    return asset($value ? 'storage/' . $value : '/images/default_avatar.jpg');
  }

  public function company()
  {
    return $this->belongsTo(Company::class, 'company_id', 'id');
  }

  public function features()
  {
    return $this->belongsToMany(Feature::class, 'vehicle_features');
  }

  public function users()
  {
    return $this->belongsToMany(User::class, 'user_vehicles', 'vehicle_id', 'user_id');
  }

  // public function features()
  // {
  //   return $this->belongsToMany('features', 'vehicle_features');
  // }
}

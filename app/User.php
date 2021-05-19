<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, Notifiable, HasRoles, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  //'avatar',
  protected $fillable = [
    'first_name', 'last_name', 'mobile', 'email', 'password', 'role'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  protected $dates = ['deleted_at'];

  // public function getAvatarAttribute($value)
  // {
  //     return asset($value ? 'storage/' . $value : '/images/default_avatar.jpg');
  // }

  public function vehicles()
  {
    return $this->belongsToMany(Vehicle::class, 'user_vehicles');
  }

  public function features()
  {
    return $this->belongsToMany(User::class, 'vehicle_features');
  }
}

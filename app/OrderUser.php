<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id', 'user_id'
    ];
}

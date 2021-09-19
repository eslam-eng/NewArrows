<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['coupon_code','coupon_value','restaurant_id'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\User','restaurant_id');
    }

}

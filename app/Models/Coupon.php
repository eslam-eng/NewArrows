<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['coupon_code','coupon_value','restaurant_name','restaurant_id'];

//    public function getRestaurantNameAttribute($value)
//    {
//        return DB::table('restaurants')->where('name',$value)->first();
//    }

}

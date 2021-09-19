<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'username','password','active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password',];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

//     relational functions

    public function category()
    {
        return $this->hasMany('App\Models\Category','restaurant_id');
    }

    public function restauarntInfo()
    {
        return $this->hasMany('App\Models\RestaurantBasicInfo','restaurant_id');
    }

    public function restauarntSocial()
    {
        return $this->hasMany('App\Models\SocialMedia','restaurant_id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product','restaurant_id');
    }

    public function coupon()
    {
        return $this->hasMany('App\Models\Coupon','restaurant_id');
    }
}

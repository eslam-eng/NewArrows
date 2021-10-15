<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone_1','phone_2','phone_3',
        'facebook','twitter','instagram','snapchat','website','restaurant_id','restaurant_name'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\User','restaurant_id');
    }
}

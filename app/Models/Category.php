<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','restaurant_name','photo','restaurant_id'];
    protected $hidden = ['restaurant_name'];
//    public function getNameAttribute($value)
//    {
//        return json_decode($value);
//    }
//
//    public function setNameAttribute($value)
//    {
//        $this->attributes['name'] = json_encode($value);
//    }

//    public function restaurant()
//    {
//        return $this->belongsTo('App\Models\User','restaurant_id');
//    }

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id');
    }
}

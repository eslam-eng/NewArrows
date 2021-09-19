<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','restaurant_id'];
    protected $hidden = ['restaurant_id'];
//    public function getNameAttribute($value)
//    {
//        return json_decode($value);
//    }
//
//    public function setNameAttribute($value)
//    {
//        $this->attributes['name'] = json_encode($value);
//    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\User','restaurant_id');
    }
}
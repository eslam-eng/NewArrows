<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','components','restaurant_id'];

    protected $hidden=["restaurant_id"];
    public function getComponentsAttribute($value)
    {
        return json_decode($value);
    }

    public function setComponentsAttribute($value)
    {
        $this->attributes['components'] = json_encode($value);
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\User','restaurant_id');
    }
}

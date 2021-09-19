<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','photo','category_id','components','sizes','additional','restaurant_id'];

    public function getComponentsAttribute($value)
    {
        return json_decode($value);
    }

    public function setComponentsAttribute($value)
    {
        $this->attributes['components'] = json_encode($value);
    }

    public function getSizesAttribute($value)
    {
        return json_decode($value);
    }

    public function setSizesAttribute($value)
    {
        $this->attributes['sizes'] = json_encode($value);
    }

    public function getAdditionalAttribute($value)
    {
        return json_decode($value);
    }

    public function setAdditionalAttribute($value)
    {
        $this->attributes['additional'] = json_encode($value);
    }
}

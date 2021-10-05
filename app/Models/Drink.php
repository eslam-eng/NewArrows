<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = ['photo','name','restaurant_id','category_id'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\User','restaurant_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
}

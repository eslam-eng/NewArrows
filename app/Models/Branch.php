<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['name','lat','lng','restaurant_id'];

//    public function setBranchesAttribute($value)
//    {
//        $this->attributes['branches'] = json_encode($value);
//    }

//    public function getBranchesAttribute($value)
//    {
//        return json_decode($value);
//    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\User','restaurant_id');
    }

}

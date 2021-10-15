<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['ads','restaurant_id','restaurant_name'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\User','restaurant_id');
    }
}

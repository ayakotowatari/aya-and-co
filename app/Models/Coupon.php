<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $guarded =[];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function status(){
        return $this->hasOne('App\Models\Status');
    }
    
}

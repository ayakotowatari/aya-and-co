<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestAddress extends Model
{
    //
    protected $guarded =[];

    public function guests(){

        return $this->belongsTo('App\Models\Guest');

    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}

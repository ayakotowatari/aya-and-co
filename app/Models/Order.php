<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded =[];

    public function user(){

        return $this->belongsTo('App\User');

    }

    public function guest(){

        return $this->belongsTo('App\Models\Guest');

    }

    public function products(){
        return $this->belongsToMany('App\Models\Product')
            ->withPivot('quantity');
    }

    public function guestAddress(){
        return $this->hasOne('App\Models\GuestAddress');
    }

    public function address(){
        return $this->hasOne('App\Models\Address');
    }

    public function postage(){
        return $this->hasOne('App\Models\Postage');
    }

    public function shipment(){
        return $this->hasOne('App\Models\Shipment');
    }

    public function status(){
        return $this->hasOne('App\Models\Status');
    }

    
}

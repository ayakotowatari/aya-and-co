<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;	//追記

class Address extends Model
{
    //
    use SoftDeletes;

    protected $guarded =[];

    public function users(){

        return $this->belongsTo('App\User');

    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    public function postage(){
        return $this->hasOne('App\Models\Postage');
    }


}

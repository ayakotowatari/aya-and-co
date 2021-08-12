<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded =[];

    public function orders(){

        return $this->belongsToMany('App\Models\Order');

    }

    public function category(){
        return $this->hasOne('App\Models\Category');
    }

    public function inventory(){
        return $this->hasOne('App\Models\ProductInventory');
    }

    public function status(){
        return $this->belongsTo('App\Models\Status');
    }

    // public function orders(){
    //     return $this->hasMany('App\Models\Order')
    //         ->withPivot('quantity');
    // }

    // public function getAbsolutePathAttribute()
    // {
    //     if(!$this->image) {
    //         return null;
    //     }

    //     // return env('AWS_URL').'/'.$this->image;
    //     return config('s3.aws_url').'/'.$this->image;
    // }
}

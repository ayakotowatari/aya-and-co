<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    public function status(){
        return $this->hasMany('App\Models\Category');
    }
}

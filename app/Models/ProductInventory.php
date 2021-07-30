<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    //
    public function product(){
        return $this->hasOne('App\Models\Product');
    }
}

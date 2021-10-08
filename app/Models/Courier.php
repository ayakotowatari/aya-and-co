<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    //
    protected $guarded =[];

    protected $appends = [
        'courier_type'
    ];

    public function getCourierTypeAttribute()
    {
        return $this->name.' '.$this->type;
    }


}

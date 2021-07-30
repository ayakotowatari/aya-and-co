<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'details',
        'description',
        'season',
        'image',
    ];

    protected $appends = [
        
        'absolute_path'
    ];

    public function products(){
        return $this->hasMany('App\Models\Product');
    }

    public function status(){
        return $this->belongsTo('App\Models\Status');
    }

    public function getAbsolutePathAttribute()
    {
        if(!$this->image) {
            return null;
        }

        // return env('AWS_URL').'/'.$this->image;
        return config('s3.aws_url').'/'.$this->image;
    }
}

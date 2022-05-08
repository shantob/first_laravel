<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\Blog','blog_id');
    }
}

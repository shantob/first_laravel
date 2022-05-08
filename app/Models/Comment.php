<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
 public function child()
 {
     return $this->hasMany('App\Models\Comment','p_id');
 }
 public function user()
 {
    return $this->belongsTo('App\Models\User', 'user_id') ;
}
public function blog()
{
    return $this->belongsTo('App\Models\Blog', 'blog_id');
}
}

<?php

namespace App;

use App\User;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
    	return $this->belongsTo('User');
    }

    public function comments()
    {
    	return $this->hasMany('Comment', 'post_id', 'id');
    }
}

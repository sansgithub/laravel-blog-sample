<?php

namespace App;

use App\User;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function post()
    {
    	return $this->belongsTo('Post');
    }
}

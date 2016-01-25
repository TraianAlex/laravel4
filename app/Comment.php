<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	/**
	 * one to many reverse
	 */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    /**
     * Polymorphic Relations
     * Get all of the comment's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
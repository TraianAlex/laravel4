<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id'];
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
    /**
     * display user for any comment in show
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment'];//last solution for add com do not have to add user_id here
	/**
	 * one to many reverse
	 */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    /**
     * Polymorphic Relations
     * Get all of the comment's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    /**
     * display user for any comment in show
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
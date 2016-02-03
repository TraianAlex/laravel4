<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['title', 'body'];
	/**
	 * one to many
	 */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    /**
     * Polymorphic Relations
     * Get all of the product's likes.
     * Once your database table and models are defined, you may access the relationships via your models. For example, to access all of the likes for a post, we can simply use the likes dynamic property:
     * $post = App\Post::find(1);
     * foreach ($post->likes as $like) {//}
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
    /**
     * Many To Many Polymorphic Relations
     * Get all of the tags for the post.
     * $post = App\Post::find(1);
     * foreach ($post->tags as $tag) {$tag->name}
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
    }
    /**
     * Eager loading
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopePublished($query)
    {
        $query->where('created_at', '<=', Carbon::now());
    }

    /**
     * Get a list of tags ids already associated with the current post
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->all();//->all() resolved the problem in form
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * Many To Many Polymorphic Relations
     * Get all of the tags for the post.
     * $video = App\Video::find(1);
     * foreach ($video->tags as $tag) {$tag->name}
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
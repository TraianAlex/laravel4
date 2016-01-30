<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	/**
	 * Has Many Through
	 * add country_id in User table and user_id in Post table
	 * The first argument passed to the hasManyThrough method is the name of the final model we wish to access, while the second argument is the name of the intermediate model.
	 * return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
	 * use $country->posts
	 */
    public function posts()
    {
        return $this->hasManyThrough('App\Post', 'App\User');
    }

    // public function users()
    // {
    // 	return $this->hasMany('App\User');
    // }
}
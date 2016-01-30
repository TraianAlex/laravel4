<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * many to many reverse
	 */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
	/**
	 * one to one reverse
	 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

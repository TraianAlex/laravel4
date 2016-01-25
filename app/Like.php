<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * Polymorphic Relations
     * Get all of the owning likeable models.
     * You may also retrieve the owner of a polymorphic relation from the polymorphic model by accessing the name of the method that performs the call to morphTo. In our case, that is the likeable method on the Like model. So, we will access that method as a dynamic property:
     * $like = App\Like::find(1);
     * $likeable = $like->likeable;
     * The likeable relation on the Like model will return either a Post or Comment instance, depending on which type of model owns the like.
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
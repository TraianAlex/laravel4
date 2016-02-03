<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Post;
use App\Comment;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'country_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    /**
     * one to one
     */
    public function phone()
    {
        return $this->hasOne('App\Phone');
    }
    /**
     * many to many
     * use $user->roles()->attach(2);
     *     $role->pivot->created_at;
     * return $this->belongsToMany('App\Role', 'user_roles'); instead of role_user tabel
     * return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
     * The third argument is the foreign key name of the model on which you are defining the relationship, while the fourth argument is the foreign key name of the model that you are joining to
     *
     * By default, only the model keys will be present on the pivot object. If your pivot table contains extra attributes, you must specify them when defining the relationship:
     * return $this->belongsToMany('App\Role')->withPivot('column1', 'column2');
     *
     * f you want your pivot table to have automatically maintained created_at and updated_at timestamps, use the withTimestamps method on the relationship definition:
     * return $this->belongsToMany('App\Role')->withTimestamps();
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    /**
     * find comments by user
     */
    public function comments()
    {
        return $this->hasManyThrough('App\Comment', 'App\Post');
    }

    /**
     * Get a list of role ids associated with the current user
     * @return array
     */
    public function getRoleListAttribute()
    {
        return $this->roles->lists('id')->all();//->all() resolved the problem in form
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'user_id');
    }

    public function hasLikedPost(Post $post)
    {
        return (bool) $post->likes->where('user_id', $this->id)->count();
    }

    public function hasLikedComment(Comment $comment)
    {
        return (bool) $comment->likes->where('user_id', $this->id)->count();
    }
}
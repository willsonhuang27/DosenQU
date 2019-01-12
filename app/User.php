<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class User extends Model
{
    public function role()
    {
        return $this->hasOne('App\Role','id','role_id');
    }

    public function thread()
    {
    	return $this->belongsToMany('App\Thread');
    }

    public function message()
    {
        return $this->belongsToMany('App\Message');
    }

    public function post()
    {
        return $this->belongsToMany('App\Post');
    }

    public function rating()
    {
        return $this->belongsToMany('App\Rating');
    }
}

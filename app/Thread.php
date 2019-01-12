<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Thread extends Model
{
    public function category() {
    	return $this->hasOne('App\Category','id','category_id'); 
    }
    public function user() {
    	return $this->belongsToMany('App\User');
    }
    public function post() {
    	return $this->hasMany('App\Post');
    }
}

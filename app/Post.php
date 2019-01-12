<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function thread() {
    	return $this->belongsTo('App\Thread');
    }

    public function user(){
    	return $this->belongsToMany('App\User');
    }
}

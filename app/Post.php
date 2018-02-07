<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['content','user_id'];
	
	public $with = ['user','likes'];
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function likes(){
		return $this->hasMany('App\Like');
	}
	
}

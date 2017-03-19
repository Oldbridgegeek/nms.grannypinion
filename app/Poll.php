<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
	protected $fillable = [
		'text','link','user_id','name',
	];
    public function replies(){
    	return $this->hasMany('App\Reply');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}

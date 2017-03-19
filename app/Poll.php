<?php

namespace App;
use User;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
	protected $fillable = [
		'text','link','user_id','name',
	];
    public function replies(){
    	return $this->hasMany(Reply::class , 'poll_id');
    }
}

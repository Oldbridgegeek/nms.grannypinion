<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		
	];

	protected $guarded = [];
	
}

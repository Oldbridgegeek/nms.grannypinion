<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
	/**
	 * Only fillable params can be used in mass assignments.
	 *
	 * @var [type]
	 */
	protected $fillable = [
		'message','room_id','user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}

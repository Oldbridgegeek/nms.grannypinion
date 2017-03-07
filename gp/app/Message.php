<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
	protected $fillable = [
		'text', 'created_at', 'conservation_id',
	];

	protected $hidden = [
		'receiver_user_id', 'sending_user_id',
	];

	public function conservation() {
		return $this->belongsTo(Conservation::class);
	}
}

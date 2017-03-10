<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'firstname', 'lastname', 'city', 'email', 'password', 'avatar',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Get the users reviews.
	 *
	 * @return [type] [description]
	 */
	public function reviews() {
		return $this->hasMany(Review::class);
	}

	/**
	 * Get all user conversations.
	 *
	 * @return [type] [description]
	 */
	public function receivedConversations() {
		return $this->hasMany(Conversation::class, 'receiver_id');
	}

	/**
	 * Get all user conversations.
	 *
	 * @return [type] [description]
	 */
	public function startedConversations() {
		return $this->hasMany(Conversation::class, 'sender_id');
	}
}

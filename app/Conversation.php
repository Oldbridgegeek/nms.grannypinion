<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
	/**
	 * Only fillable params can be used in mass assignments.
	 * 
	 * @var [type]
	 */
    protected $fillable = [
		'sending_user_id', 'receiving_user_id',
	];

	/**
	 * Get all messages from this conversation.
	 * 
	 * @return [type] [description]
	 */
	public function messages()
	{
		return $this->hasMany(Message::class);
	}

	/**
	 * Get the sending user.
	 * 
	 * @return [type] [description]
	 */
	public function sender()
	{
		return $this->belongsTo(User::class, 'sender_id');
	}

	/**
	 * Add sender to conversation.
	 * 
	 * @param User $user [description]
	 */
	public function addSender(User $user)
	{
		return $this->sender()->associate($user);
	}

	/**
	 * Get the receiving user.
	 * 
	 * @return [type] [description]
	 */
	public function receiver()
	{
		return $this->belongsTo(User::class, 'receiver_id');
	}

	/**
	 * Add receiver to conversation.
	 * 
	 * @param User $user [description]
	 */
	public function addReceiver(User $user)
	{
		return $this->receiver()->associate($user);
	}
}

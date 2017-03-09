<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	/**
	 * Only fillable params can be used in mass assignments.
	 * 
	 * @var [type]
	 */
    protected $fillable = [
		'body', 'conservation_id',
	];

	/**
	 * Get the conversation this message belongs to.
	 * 
	 * @return [type] [description]
	 */
	public function conversation()
	{
		return $this->belongsTo(Conversation::class);
	}

	/**
	 * Link message with a conversation.
	 * 
	 * @param  Conversation $conversation [description]
	 * @return [type]                     [description]
	 */
	public function linkToConversation(Conversation $conversation)
	{
		return $this->conversation()->associate($conversation);
	}
}

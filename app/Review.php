<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	/**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the subject of this review.
     * 
     * @return [type] [description]
     */
	public function subject()
	{
		return $this->belongsTo(User::class);
	}

    public function addSubject(User $user)
    {
        return $this->subject()->associate($user);
    }
}

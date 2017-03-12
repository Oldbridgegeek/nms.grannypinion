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
		'stars_average', 'stars_kindness', 'stars_attractiveness', 'stars_reliability', 'stars_honesty', 'stars_intelligence', 'stars_fun', 'subject_id', 'user_id', 'feedback',
	];

	protected $guarded = [];

	/**
	 * Get the subject of this review.
	 *
	 * @return [type] [description]
	 */
	public function subject() {
		return $this->belongsTo(User::class);
	}

	public function addSubject($user_id) {
		$user = User::find($user_id);
		return $this->subject()->associate($user);
	}
}

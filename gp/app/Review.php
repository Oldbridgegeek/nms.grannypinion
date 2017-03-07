<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
	protected $fillable = [
		'starsAverage', 'starsHonesty', 'starsReliability', 'starsFun', 'starsAttractiveness', 'starsIntelligence', 'starsKindness', 'feedbackString', 'user_id',
	];

	public function user() {
		return $this->belongsTo(User::class);
	}
}

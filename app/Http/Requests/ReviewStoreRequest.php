<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'user_id' => 'required|exists:users,id',
			'stars_average' => 'integer|max:' . config('review.max_stars'),
			'stars_kindness' => 'integer|max:' . config('review.max_stars'),
			'stars_attractiveness' => 'integer|max:' . config('review.max_stars'),
			'stars_reliability' => 'integer|max:' . config('review.max_stars'),
			'stars_honesty' => 'integer|max:' . config('review.max_stars'),
			'stars_intelligence' => 'integer|max:' . config('review.max_stars'),
			'stars_fun' => 'integer|max:' . config('review.max_stars'),
		];
	}
}

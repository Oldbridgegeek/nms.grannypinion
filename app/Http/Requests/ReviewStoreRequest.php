<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:user,id',
            'stars_average' => 'required|integer|max:'.config('review.max_stars'),
            'stars_kindness' => 'required|integer|max:'.config('review.max_stars'),
            'stars_attractiveness' => 'required|integer|max:'.config('review.max_stars'),
            'stars_reliability' => 'required|integer|max:'.config('review.max_stars'),
            'stars_honesty' => 'required|integer|max:'.config('review.max_stars'),
            'stars_intelligence' => 'required|integer|max:'.config('review.max_stars'),
            'stars_fun' => 'required|integer|max:'.config('review.max_stars'),
            'feedback' => 'min:'.config('review.minimum_feedback'),
        ];
    }
}

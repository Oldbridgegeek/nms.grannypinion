<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
	const STAR_RATING = 1;
	const TEXT_INPUT = 2;
	const TEXT_AREA = 3;

    public $table = 'surveys_questions';
    public $fillable = ['title','type'];

    public function isStarRating()
    {
    	return $this->type === SurveyQuestion::STAR_RATING;
    }

    public function isTextInput()
    {
    	return $this->type === SurveyQuestion::TEXT_INPUT;
    }

    public function isTextArea()
    {
    	return $this->type === SurveyQuestion::TEXT_AREA;
    }

    public function answer()
    {
        return $this->hasMany(SurveyQuestionValue::class, 'survey_question_id','id');
    }


}

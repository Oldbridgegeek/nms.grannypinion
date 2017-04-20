<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    public $table = 'surveys_questions';
    public $fillable = ['title','type'];
}

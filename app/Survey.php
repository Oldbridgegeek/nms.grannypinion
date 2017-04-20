<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Survey extends Model
{
    public $fillable = [
   		'description',
   		'title',
   		'user_id',
   		'link'
    ];

    public static function createSurvey($data)
    {
        return Survey::create([
          'title' => $data['title'],
          'description' => $data['description'],
          'user_id' => Auth::user()->id,
          'link' => sha1(time()),
        ]);
    }

    public function questions()
    {
    	return $this->hasMany(SurveyQuestion::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}

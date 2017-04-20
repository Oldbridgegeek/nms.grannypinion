<?php

namespace App;
Use App\User;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
    	'poll_id','text', 'user_id',
    ];

    public function survey() {
    	return $this->belongsTo(Survey::class);
    }
}

<?php

namespace App;
Use User;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
    	'poll_id','text', 'user_id',
    ];

    public function poll() {
    	return $this->belongsTo(Poll::class);
    }
}

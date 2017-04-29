<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsUsers extends Model
{
    protected $fillable = ['pal_id','room_id','created_id'];

    public function room()
    {
    	return $this->belongsTo(Room::class);
    }

    public function pal()
    {
    	return $this->belongsTo(User::class,'pal_id');
    }

    public static function getCreatedID($roomID)
    {
    	return self::where('room_id',$roomID)->where('created_id','!=',NULL)->first()->created_id;
    }

    public function anonymousChat()
    {
        return $this->created_id == $this->user_id;
    }
}

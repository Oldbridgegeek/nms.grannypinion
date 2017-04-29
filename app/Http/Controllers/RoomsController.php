<?php

namespace App\Http\Controllers;

use Auth;
use App\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
    	$rooms = Auth::user()->rooms;
    	return view('chat.index', compact('rooms'));
    }

    public function room($id)
    {
    	return view('chat.room');
    }

    public function create($user_id)
    {
    	$existingRooms = $this->getExistingRooms($user_id);
        if (count($existingRooms)) {
            $roomID = $this->isUserCreatorOneOf($existingRooms);
            if ($roomID != null) {
                return redirect()->action(
                    'RoomsController@room', ['id' => $roomID]
                );
            }
            return $this->createRoomAndRedirect($user_id);

        }

        return $this->createRoomAndRedirect($user_id);
    }

    private function getExistingRooms($id)
    {
        return Auth::user()->rooms()->where('pal_id',$id)->get(); 
    }

    private function isUserCreatorOneOf($existingRooms)
    {
        foreach ($existingRooms as $room) {
             if($room->created_id == Auth::user()->id)
             {
                return $room->room_id;
             }
        }
        return null;
    }

    private function createRoomAndRedirect($id)
    {
    	$newRoom = Room::create();
    	$roomID = Auth::user()->rooms()->create([
    		'pal_id'	=>	$id,
    		'room_id'	=>	$newRoom->id,
    		'created_id'	=>	Auth::user()->id
    	])->room_id;

    	return redirect()->action(
            'RoomsController@room', ['id' => $roomID]
        );	
    }

}

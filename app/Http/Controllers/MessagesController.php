<?php

namespace App\Http\Controllers;

use Auth;
use App\Room;
use App\User;
use App\Message;
use App\RoomsUsers;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	private $image = '/uploads/avatars/default/default.jpg';

    public function index()
    {
    	$rooms = Auth::user()->rooms;
    	return view('chat.index', compact('rooms'));
    }

    public function room($id)
    {
    	return view('chat.room');
    }

    public function getPal($roomID)
    {
    	$pal = Auth::user()->myPal($roomID);
    	return $pal;
    }

    public function create($id)
    {
    	$existingRoom = Auth::user()->rooms()->where('pal_id',$id)->first();
    	if ($existingRoom != null) {
    		return redirect()->action(
			    'MessagesController@room', ['id' => $existingRoom->id]
			);
    	}

    	//create a room and then redirect
    	$newRoom = Room::create();
    	$newRoomID = $this->makeRoom($id, $newRoom->id);
    	

    	return redirect()->action(
		    'MessagesController@room', ['id' => $newRoomID]
		);
    }

    private function makeRoom($id, $newRoomID)
    {
    	return Auth::user()->rooms()->create([
    		'pal_id'	=>	$id,
    		'room_id'	=>	$newRoomID,
    		'created_id'	=>	Auth::user()->id
    	])->id;
    }

    public function sendMessage(Request $request)
    {
    	extract($request->all());
    	$pal = User::find($pal_id);
    	if (!$pal->hasRoom($room_id)) {
    		$pal->rooms()->create([
    			'pal_id'	=>	$user_id,
    			'room_id'	=>	$room_id
    		]);
    	}

    	$message = Message::create([
    		'user_id' => $user_id,
    		'message'	=>	$message,
    		'room_id'	=>	$room_id
    	]);
        $user = Auth::user();
    	broadcast(new MessageSent($message, $user))->toOthers();

    }

    public function getData($roomID)
    {
    	$pal = Auth::user()->myPal($roomID);
    	$messages = Message::where('room_id',$roomID)->get();
    	$created_id = RoomsUsers::getCreatedID($roomID);
    	return response()->json([
    		'pal'			=>	[
    			'id'	=>	$pal->id,
				'fullName'	=>	$pal->getFullName(),
				'image'		=>	$pal->getImage()
    		],
			'currentUser'	=>	[
				'id'	=>	Auth::user()->id,
				'fullName'	=>	Auth::user()->getFullName(),
				'image'		=>	Auth::user()->getImage()
			],
			'additionalInfo'	=>	[
				// 'default_image'	=>	$this->image,
				'created_id'	=> $created_id,
				'chatWith'			=>	trans('app.chat_with'),
				'typeMessageHere'	=>	trans('app.type_message_here'),
				'send'				=>	trans('app.send'),
				'anonymousUser' 	=> trans("app.anonymous_user"),
			],

			'messages'	=>	$this->buildMessages($messages),
		]);
    }

    private function buildMessages($messages)
    {
    	$data = [];

    	foreach ($messages as $item) {
    		$data[] = [
    			'text'	=>	$item->message,
    			'user'	=>	[
    				'id'	=>	$item->user->id,
    				'image'	=>	$item->user->getImage()
    			]
    		];
    	}

    	return $data;
    }
}

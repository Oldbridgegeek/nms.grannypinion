<?php

namespace App\Http\Controllers;

use Auth;
use App\Room;
use App\User;
use App\Message;
use App\RoomsUsers;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Notifications\ChatStarted;
use Illuminate\Support\Facades\Notification;

class MessagesController extends Controller
{

    public function index()
    {
        
    }
	public function __construct()
	{
		$this->middleware('auth');
	}
	private $image = '/uploads/avatars/default/default.jpg';

    

    public function getPal($roomID)
    {
    	$pal = Auth::user()->myPal($roomID);
    	return $pal;
    }

    private function openRoomFor($pal_id, $room_id, $user_id)
    {
        $pal = User::find($pal_id);
        if (!$pal->hasRoom($room_id)) {
            $pal->rooms()->create([
                'pal_id'    =>  $user_id,
                'room_id'   =>  $room_id
            ]);
            Notification::send($pal,new ChatStarted($room_id,trans('app.anonymous_user')));       
        }
    }

    public function sendMessage(Request $request)
    {
    	extract($request->all());
    	$pal = $this->openRoomFor($pal_id, $room_id, $user_id);

    	$message = Message::create([
    		'user_id' => $user_id,
    		'message'	=>	$message,
    		'room_id'	=>	$room_id
    	]);

        $user = Auth::user();
    	broadcast(new MessageSent($message, $user, $room_id))->toOthers();
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
				'created_id'	   => $created_id,
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

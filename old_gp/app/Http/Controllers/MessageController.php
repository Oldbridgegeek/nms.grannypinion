<?php
namespace App\Http\Controllers;
use App\Conversation;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller {
	public function store(Request $request) {
		// Create new conversation if it does not exist yet
		$conversation = new Conversation;
		$conversation->user_id_1 = $request->sending_user_id;
		$conversation->user_id_2 = $request->receiving_user_id;
		\DB::table('conversations')->insert(['user_id_1' => $conversation->user_id_1, 'user_id_2' => $conversation->user_id_2]);

		$conv_id = 0;
		$conversations = Conversation::all();
		foreach ($conversations as $conv) {
			if ($conv->user_id_1 == $request->sending_user_id) {
				if ($conv->user_id_2 == $request->receiving_user_id) {
					$conv_id = $conv->id;
				}
			};
		}

		$message = new Message;
		$message->text = $request->text;
		$message->created_at = $request->timestamp;
		$message->conversation_id = $conv->id;
		$message->receiving_user_id = $request->receiving_user_id;
		$message->sending_user_id = $request->sending_user_id;

		\DB::table('messages')->insert(['text' => $message->text, 'created_at' => $message->created_at, 'conversation_id' => $message->conversation_id, 'receiving_user_id' => $message->receiving_user_id, 'sending_user_id' => $message->sending_user_id]);
		return redirect('/');
	}

	public function message(User $user) {
		return view('message', compact('user'));
	}

}
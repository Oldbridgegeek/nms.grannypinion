<?php
namespace App\Http\Controllers;
use App\Conversation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ConversationController extends Controller {
	public function store(Request $request) {
		// Create new conversation if it does not exist yet
		$conversation = new Conversation;
		$conversation->user_id_1 = $request->sending_user_id;
		$conversation->user_id_2 = $request->receiving_user_id;
		\DB::table('conversations')->insert(['user_id_1' => $conversation->user_id_1, 'user_id_2' => $conversation->user_id_2]);
	}

	public function view_conversations(User $user) {
		$conversations = Conversation::all();
		$conversationsStarted = array();
		$conversationsReceived = array();
		foreach ($conversations as $conversation) {
			if ($conversation->user_id_1 == $user->id) {
				$conversationsStarted[] = $conversation;
			}
			if ($conversation->user_id_2 == $user->id) {
				$conversationsReceived[] = $conversation;
			}
		}

		return view('mymessages', compact('conversationsStarted', 'conversationsReceived'));

	}

	public function view_messages(Conversation $conversation) {
		$messages = $conversation->messages;
		return view('conversation', compact('messages'));
	}
}
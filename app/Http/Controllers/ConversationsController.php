<?php

namespace App\Http\Controllers;

use App\User;
use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Requests\ConversationStoreRequest;

class ConversationsController extends Controller
{
	/**
	 * Show all conversations of a user.
	 * 
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function index(User $user)
	{
		$conversationsStarted = $user->startedConversations;
		$conversationsReceived = $user->receivedConversations;

		return view('conversation.index', compact('conversationsStarted', 'conversationsReceived'));
	}

	/**
     * Show the form for creating a new conversation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('conversation.create', compact('user'));
    }

	/**
	 * Store a conversation.
	 * 
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function store(ConversationStoreRequest $request) {
		// Create new conversation if it does not exist yet
		$conversation = new Conversation;
		$conversation->addSender(Auth::user());
		$conversation->addReceiver($request->receiver_id);
		$conversation->save();

		$message = new Message([ 'body' => $request->body ]);
		$message->linkToConversation($conversation);
		$message->save();

		return redirect('conversations');
	}

	/**
	 * Display a conversation.
	 * 
	 * @param  Conversation $conversation [description]
	 * @return [type]                     [description]
	 */
	public function show(Conversation $conversation)
	{
		return view('conversation.show', compact('conversation'));
	}
}

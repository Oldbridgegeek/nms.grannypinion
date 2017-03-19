<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Poll;
use Auth;
use User;
use Illuminate\Http\Request;
use Mail;

class ReplyController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Poll $poll) {
		//$link = (string)$link;
		//$poll = DB::table('polls')->where('link','=',$link)->get();
		return view('poll.reply',compact('poll'));
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
	 	$poll = Poll::find($request->poll_id);
	 	$user = $poll->user;

		$reply = new Reply([
			'user_id' => $request->user_id,
			'poll_id' => $request->poll_id,
			'text' => $request->text,
	
		]);
		Mail::send('email.reply', ['poll' => $poll ,'user' =>  $user], function ($message) use ($user) {
			$message->from('witwitenes@gmail.com', 'Grannypinion - Neue Antwort');
			$message->to( $user->email );
		});


		$reply->save();

		return redirect('/'+Auth::user()->id);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
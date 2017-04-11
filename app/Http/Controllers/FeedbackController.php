<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Mail;
use App\Mail\FeedbackAdded;
use App\Feedback;

class FeedbackController extends Controller {

	use ValidatesRequests;

	public function __construct()
	{
		$this->middleware('interactingWithYourselfNotAllowed');
	}
	/**
	 * Display all feedback of a user.
	 *
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function index(User $user) {
		return view('user.feedback.index', compact('user'));
	}

	/**
	 * Display feedback form for a user.
	 *
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function create(User $user) {
		return view('user.feedback.create', compact('user'));
	}

	public function leave(User $user, Request $request)
	{
		$this->validate($request, [
			'text'=>'required'
		]);

		$feedback = new Feedback();
		$feedback->assignToUser($request->get('text'), $user->id);
		\Mail::to($user)->send(new FeedbackAdded($user));

		return redirect('/feedback/success');

	}

	public function success()
	{
		return view('user.feedback.thanks');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
	/**
	 * Display all feedback of a user.
	 * 
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
    public function index(User $user)
    {
        return view('user.feedback.index', compact('user'));
    }

    /**
	 * Display feedback form for a user.
	 * 
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
    public function create(User $user)
    {
        return view('user.feedback.index', compact('user'));
    }
}

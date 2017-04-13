<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;

class FeedbackCommentsController extends Controller
{
    public function add(Request $request)
    {
		$comment = Feedback::addComment($request->all());
		return view('user._newComment', compact('comment'));
	}
}

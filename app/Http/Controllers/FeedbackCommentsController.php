<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\FeedbackComment;

class FeedbackCommentsController extends Controller
{
    public function add(Request $request)
    {
		$data = Feedback::addComment($request->all());
		Feedback::sendCommentAddedMail($data['feedback'], $data['comment']);
		if ($data['comment_parent'] != null) 
		{
			Feedback::sendCommentAddedMail($data['comment_parent'], $data['comment_parent']);
		}

		return view('user._newComment', ['comment'=>$data['comment']]);
	}
}

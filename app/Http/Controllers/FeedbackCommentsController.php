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
		if ($data['comment_parent'] != null && $data['comment_parent']->user->id != $data['comment_parent']->feedback->user->id) 
		{
			//survey user's id should not be equal parent-comment user's id
			// if($data['comment_parent']->user->id != $data['comment_parent']->feedback->user->id)
			// {
				Feedback::sendCommentAddedMail($data['comment_parent'], $data['comment']);
			// }
		}

		return view('user._newComment', ['comment'=>$data['comment']]);
	}
}

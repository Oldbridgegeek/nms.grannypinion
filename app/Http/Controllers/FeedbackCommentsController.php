<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Feedback;
use App\FeedbackComment;

class FeedbackCommentsController extends Controller
{
    public function add(Request $request)
    {
    	return [true];
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

	public function store(Request $request)
	{
		$text = $request->get('comment');

		if (empty($text) || $text == null) 
		{
			return [false];
		}

		$feedback_id = $request->get('feedback_id');

		$feedback = $this->getFeedback($feedback_id);

		$comment = new FeedbackComment;
		$comment->text = $text;
		$comment->user_id = Auth::user()->id;
		$comment->feedback_id = $feedback->id;
		$comment->save();

		return [$feedback->comments()->save($comment)];
	}

	private function getFeedback($feedback_id)
	{
		$feedback = Feedback::find($feedback_id);
		if ($feedback === null) {
			return [false];
		}

		return $feedback;
	}

	public function addReply(Request $request)
	{
		$newComment = $request->get('newComment');
		$parentComment = $request->get('parentComment');

		$comment = new FeedbackComment;
		$comment->text = $newComment['text'];
		$comment->user_id = Auth::user()->id;
		$comment->feedback_id = $parentComment['feedback']['id'];
		$comment->parent_id = $parentComment['id'];
		return [$comment->save()];

	}
}

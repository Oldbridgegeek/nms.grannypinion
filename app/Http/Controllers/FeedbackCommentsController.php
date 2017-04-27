<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use App\Feedback;
use App\FeedbackComment;
use App\Mail\CommentAdded;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;


class FeedbackCommentsController extends Controller
{
	use ValidatesRequests;
	/**
	###==================================
	### This class should be _refactored_ 
	### Any approach in here is not ideal!
	*/
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
		$replyTo = $request->get('replyTo');
		$text = $request->get('comment');
		$anonymous = (int) $request->get('anonymous');

		$this->validate($request, [
			'comment'=>'required'
		]);

		$feedback_id = $request->get('feedback_id');

		$feedback = $this->getFeedback($feedback_id);

		$comment = FeedbackComment::addComment($request->all());

		//sending email to feedback's owner
		if ($this->isCommentAddedToFeedbackItself($replyTo, $comment, $feedback)) {
			$this->sendEmailToFeedbackOwner($feedback, $comment, $anonymous);
		}

		if ($this->isThisReply($replyTo)) {
			//replyTo has info about WHO's comment was answered
			//therefore, that person needs to get an email
			$this->sendEmailToReplyReceiver($replyTo, $comment, $anonymous);
		}

		return [$feedback->comments()->save($comment)];
	}

	private function sendEmailToReplyReceiver($replyTo, $comment, $anonymous)
	{
		$user = User::find($replyTo['user']['id']);
		if ($user->canReceiveEmails()) {
			if ($anonymous == true) {
				\Mail::to($user)->send(new CommentAdded($user, $comment, trans("app.anonymous_user")));
			}
			else
			{
				\Mail::to($user)->send(new CommentAdded($user, $comment, Auth::user()->getFullName()));	
			}
		}
	}

	private function isThisReply($replyTo)
	{
		return is_array($replyTo);
	}

	private function isCommentAddedToFeedbackItself($replyTo, $comment, $feedback)
	{
		return $replyTo == null && $comment->user->id != $feedback->user->id;
	}

	private function sendEmailToFeedbackOwner($feedback, $comment, $anonymous)
	{
		if ($feedback->user->canReceiveEmails()) {
			if ($anonymous == true) {
				\Mail::to($feedback->user)->send(new CommentAdded($feedback->user, $comment, trans("app.anonymous_user")));
			}
			else
			{
				\Mail::to($feedback->user)->send(new CommentAdded($feedback->user, $comment, Auth::user()->getFullName()));
			}
		}
	}

	private function getFeedback($feedback_id)
	{
		$feedback = Feedback::find($feedback_id);
		if ($feedback === null) {
			return response([false],401);
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

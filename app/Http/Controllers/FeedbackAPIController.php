<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Feedback;

class FeedbackAPIController extends Controller
{
    public function getFeedbacks(Request $request)
	{
		$user_id = $request->get('user_id');

		$user = User::find($user_id);
		$feedbacks = $user->feedbacks()
						->latest()
						->with(['comments' => function($q){
							$q->where('parent_id',NULL);
						}])
						->get();
		// $currentGuestData = [
		// 	'id'
		// ];
		// $currentUser = Auth::check() ? Auth::user() : '';

		return response()->json([
			'confirmationQuestion'	=>	trans('app.you_sure?'),
			'messages'			=>	[
				'makePublic'			=>	trans('app.make_public'),
				'makePrivate'			=>	trans('app.make_private'),
				'addReply'				=>	trans('app.add_reply'),
				'justNow'				=>  trans('app.just_now'),
				'reply'					=> 	trans('app.reply'),
				'reply_anonymously'		=>	trans('app.reply_anonymously'),
				'anonymousName'			=>	trans("app.anonymous_reply"),
				'defaultImage'			=>	'/uploads/avatars/default/default.jpg'
				
			],
			'currentUser'	=>	[
				'id'	=>	Auth::check() ? Auth::user()->id : '0',
				'fullName'	=>	Auth::check() ? Auth::user()->getFullName() : '',
				'image'		=>	Auth::check() ? Auth::user()->getImage() : ''
			],
			'feedbacks'	=>	$this->buildFeedbacks($feedbacks),
			'feedbacksCount' => count($feedbacks)
		]);
	}

	private function buildFeedbacks($feedbacks)
	{
		$data = [];
		$currentUser_id = Auth::check() ? Auth::user()->id : 0;
		foreach ($feedbacks as $feedback) {
			$data[] = [
				'id'		=>	$feedback->id,
				'title'		=>	trans('app.feedback_title'),
				'content'	=>	$feedback->text,
				'date'		=>	$feedback->created_at->diffForHumans(),
				'isAuthor'	=>	$currentUser_id == $feedback->user_id,
				'isStatusPublic'	=>	$feedback->status == 1 ? true : false,
				'comments'	=> $this->buildComments($feedback->comments),
				'newComment'=>	'',
				'replyTo'	=>	'',
				'anonymousReply' => false
			];
		}
		return $data;
	}

	public function buildComments($comments)
	{
		$data = [];

		foreach ($comments as $item) {
			$data[] = [
				'id'	=>	$item->id,
				'text'	=>	$item->text,
				'action'	=>	trans('app.reply'),
				'feedback'	=>	$item->feedback,
				'anonymous'	=>	$item->anonymous,
				'date'		=>	$item->created_at->diffForHumans(),
				'user'		=>	[
					'id'	=>	$item->user->id,
					'fullName'	=>	$item->anonymous ? trans("app.anonymous_reply") : $item->user->getFullName(),
					'image'		=>	$item->anonymous ? '/uploads/avatars/default/default.jpg' :$item->user->getImage()
				],
				'children'		=>	$this->buildComments($item->children)
			];
		}

		return $data;
	}

	public function toggleStatus(Request $request)
	{
		$feedback_id = $request->get('feedback_id');

		$feedback = Feedback::find($feedback_id);
		if ($feedback->user_id != Auth::user()->id) {
			return response([false],401);;
		}
		$feedback->toggleStatus();
		return [true];
		// return view('user.feedback.status',compact('feedback'));
	}

	public function deleteFeedback(Request $request)
	{
		$feedback_id = $request->get('feedback_id');

		$feedback = Feedback::find($feedback_id);
		if ($feedback->user_id != Auth::user()->id) {
			return response([false],401);;
		}
		return ['status'=>$feedback->delete()];
	}

}

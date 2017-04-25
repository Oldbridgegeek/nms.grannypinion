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

		$user = User::where('id',$user_id)->with(['feedbacks' => function($q){
			$q->latest();
			$q->with('comments.children');
		}])->first();
		dd($user);
		return response()->json([
			'confirmationQuestion'	=>	trans('app.you_sure?'),
			'messages'			=>	[
				'makePublic'			=>	trans('app.make_public'),
				'makePrivate'			=>	trans('app.make_private'),
				'addReply'				=>	trans('app.add_reply'),
				'justNow'				=>  trans('app.just_now'),
				'reply'					=> trans('app.reply')
			],
			'currentUser'	=>	[
				'id'	=>	Auth::user()->id,
				'fullName'	=>	Auth::user()->getFullName(),
				'image'		=>	Auth::user()->getImage()
			],
			'feedbacks'	=>	$this->buildFeedbacks($user->feedbacks)
		]);
	}

	private function buildFeedbacks($feedbacks)
	{
		$data = [];

		foreach ($feedbacks as $feedback) {
			$data[] = [
				'id'		=>	$feedback->id,
				'title'		=>	trans('app.feedback_title'),
				'content'	=>	$feedback->text,
				'date'		=>	$feedback->created_at->diffForHumans(),
				'isAuthor'	=>	Auth::user()->id == $feedback->user_id,
				'isStatusPublic'	=>	$feedback->status == 1 ? true : false,
				'comments'	=> $this->buildComments($feedback->comments)
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
				'date'		=>	$item->created_at->diffForHumans(),
				'user'		=>	[
					'id'	=>	$item->user->id,
					'fullName'	=>	$item->user->getFullName(),
					'image'		=>	$item->user->getImage()
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
			return [false];
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
			return [false];
		}
		return ['status'=>$feedback->delete()];
	}


}

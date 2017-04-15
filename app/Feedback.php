<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\FeedbackComment;
use Auth;
use App\Mail\CommentAdded;
use Mail;

class Feedback extends Model {
	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	const STATUS_PRIVATE = 0;
	const STATUS_PUBLIC = 1;

	public $table = 'feedbacks';

	protected $fillable = [
		
	];

	protected $guarded = [];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function assignToUser($text, $user_id)
	{
		$this->text = $text;
		$this->user_id = $user_id;
		$this->save();
	}

	public function comments()
	{
		return $this->hasMany(FeedbackComment::class);
	}

	public static function addComment($data)
	{
		$comment_id = $data['comment_id'];
		$text = $data['text'];
		
		$feedback = self::find($data['feedback_id']);
		if ($feedback !== null) {
			$comment = $feedback->comments()->create([
				'parent_id' => $comment_id,
				'text' => $text,
				'user_id' => Auth::user()->id
			]);
		}

		$parentComment = FeedbackComment::find($comment_id);
		$data = [
			'comment'	=>	$comment,
			'feedback'	=>	$feedback,
			'comment_parent'	=>	$parentComment
		];
		return $data;
	}

	public static function sendCommentAddedMail($feedback, $comment)
	{
		if ($feedback->user->isEmailConfirmed() && $feedback->user->canReceiveEmails()) {
			if ($feedback->user->id != Auth::user()->id) {
				\Mail::to($feedback->user)->send(new CommentAdded($feedback->user, $comment, Auth::user()));	
			}
			
		}
	}
	public function toggleStatus()
	{
		if ($this->status == self::STATUS_PUBLIC) {
			$this->status = self::STATUS_PRIVATE;
		}
		else
		{
			$this->status = self::STATUS_PUBLIC;	
		}
		return $this->save();
	}

	public function isPublic()
	{

		return $this->status == 1 ? true : false;
	}
}

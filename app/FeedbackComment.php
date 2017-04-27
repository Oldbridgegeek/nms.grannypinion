<?php

namespace App;

use App;
use Auth;
use App\Feedback;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FeedbackComment extends Model
{
    public $table = 'feedbacks_comments';
    public $fillable = [
        'feedback_id',
        'text',
    ];

    public function feedback()
    {
    	return $this->belongsTo(Feedback::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function children()
    {
    	return $this->hasMany(FeedbackComment::class, 'parent_id');
    }

    public static function addComment($data)
    {
        $comment = new static;

        $comment->text = $data['comment'];
        $comment->user_id = Auth::user()->id;
        $comment->feedback_id = $data['feedback_id'];
        $comment->parent_id = isset($data['replyTo']) ? $data['replyTo']['id'] : NULL;
        $comment->anonymous = (int) $data['anonymous'];
        $comment->save();
        return $comment;
    }
    
}

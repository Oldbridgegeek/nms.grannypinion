<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\FeedbackComment;

class CommentAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $comment;
    public $commentSender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, FeedbackComment $comment, $commentSender )
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->commentSender = $commentSender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.comment_added');
    }
}

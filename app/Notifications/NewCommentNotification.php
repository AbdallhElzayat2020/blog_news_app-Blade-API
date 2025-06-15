<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{

    use Queueable;

    public $comment, $post;

    public function __construct($comment, $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     *
     * @return array<int, string>
     */

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->comment->user_id,  // 'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
//            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'comment' => $this->comment->comment,
            'link' => route('frontend.post.show', $this->post->slug),
        ];
    }

}

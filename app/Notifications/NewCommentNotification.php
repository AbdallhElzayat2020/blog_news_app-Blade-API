<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewCommentNotification extends Notification implements ShouldBroadcast
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
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        //it send for all channels but i'm using for database and broadcast each channel has its own method
        return [
            'user_id' => $this->comment->user_id,
            'user_name' => $this->comment->user->name,
            'post_title' => $this->post->title,
            'comment' => $this->comment->comment,
            'link' => route('frontend.post.show', $this->post->slug),
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'user_id' => $this->comment->user_id,
            'user_name' => $this->comment->user->name,
            'post_title' => $this->post->title,
            'comment' => $this->comment->comment,
            'link' => route('frontend.post.show', $this->post->slug),
        ];
    }

}

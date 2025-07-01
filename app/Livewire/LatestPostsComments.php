<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LatestPostsComments extends Component
{
    public function render()
    {
        $latest_posts = Post::whereStatus('active')
            ->with(['category', 'user'])
            ->withCount('comments')
            ->active()
            ->latest()
            ->take(6)
            ->get();

        $latest_comments = Comment::with(['user', 'post'])
            ->latest()
            ->take(6)
            ->get();

        if (!$latest_posts) {
            $latest_posts = [];
        }

        if (!$latest_comments) {
            $latest_comments = [];
        }

        return view('livewire.latest-posts-comments', [
            'latest_posts' => $latest_posts,
            'latest_comments' => $latest_comments,
        ]);
    }
}

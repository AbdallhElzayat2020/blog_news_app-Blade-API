<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Reports extends Component
{
    public function render()
    {
        $active_categories = Category::active()->count();
        $active_posts = Post::active()->count();
        $active_comments = Comment::count();
        $active_users = User::count();

        return view('livewire.reports', [
            'active_categories' => $active_categories,
            'active_posts' => $active_posts,
            'active_comments' => $active_comments,
            'active_users' => $active_users,
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class DashBoard extends Component
{
    public function render()
    {
        //totalUsers
        $totalUsers = User::all()->count();
        //totalPosts
        $totalPosts = Post::all()->count();
        //totalComments
        $totalComments = Comment::all()->count();
        return view('livewire.admin.dash-board',
        [
            'totalUsers' => $totalUsers,
            'totalPosts' => $totalPosts,
            'totalComments' => $totalComments,
        ]
        )->layout('layouts.user');
    }
}

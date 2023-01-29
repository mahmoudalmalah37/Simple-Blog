<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;

class Profile extends Component
{
   //show user profile
    public $user;
    public $userPostTotal;
    public $userPost;

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
        $this->userPostTotal = Post::where('author', $this->user->name)->count();
        $this->userPost = Post::where('author', $this->user->name)->latest()->get();
    }

    public function render()
    {
        return view('livewire.user.profile')->layout('layouts.user');
    }
}

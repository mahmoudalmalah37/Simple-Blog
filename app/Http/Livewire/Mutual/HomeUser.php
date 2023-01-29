<?php

namespace App\Http\Livewire\Mutual;

use App\Models\Post;
use Livewire\Component;

class HomeUser extends Component
{
    public $topView;
    public $totalLike;

    protected $listeners=['deletePost'=>'deletePost'];


    public function mount()
    {
        $this->topView = Post::orderBy('views', 'desc')->take(5)->get();
        $this->totalLike = Post::orderBy('likes', 'desc')->take(5)->get();
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->comments()->delete();
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
    }


    public function render()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('livewire.mutual.home-user',[
            'posts' => $posts,
        ])->layout('layouts.user');
    }
}

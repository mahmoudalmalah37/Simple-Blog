<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashBordUser extends Component
{
    public $searchTerm;
    protected $listeners=['deletePost'=>'deletePost','deleteComment'=>'deleteComment'];

    public function deletePost($post_id)
    {
        $post = Post::find($post_id);
        $post->comments()->delete();
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
    }

    public function render()
    {
        $search = '%'.$this->searchTerm.'%';
        $posts = Post::where('title', 'like',$search)
            ->where('author',Auth::user()->name)
            ->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.user.dash-bord-user',['posts' => $posts])->layout('layouts.user');
    }
}

<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;

class AllPost extends Component
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
            ->orWhere('slug', 'like',$search)
            ->orWhere('author', 'like',$search)
            ->orWhere('date', 'like',$search)
            ->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.post.all-post',['posts' => $posts])->layout('layouts.user');
    }
}

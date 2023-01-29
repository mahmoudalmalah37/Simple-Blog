<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class TrashPost extends Component
{
    public function restore($post_id)
    {
        Post::withTrashed()->find($post_id)->restore();
        Comment::withTrashed()->where('post_id',$post_id)->restore();
        session()->flash('message','Post Restored Successfully');
    }

    //delete post
    public function delete($post_id)
    {
        Post::withTrashed()->find($post_id)->forceDelete();
        session()->flash('message','Post Deleted Successfully');
    }
    

    public function render()
    {
        $posts = Post::onlyTrashed()->orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.post.trash-post',['posts' => $posts])->layout('layouts.user');
    }
}

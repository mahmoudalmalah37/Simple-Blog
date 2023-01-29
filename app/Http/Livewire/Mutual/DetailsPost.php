<?php

namespace App\Http\Livewire\Mutual;


use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DetailsPost extends Component
{
    use WithPagination;
    public $posts;
    public $comment;
    public $user;
    public $comments;
    public $likes;
    public $dislike;
    public $slug;
    public $isLiked = false;
    public $updateMode = false;
    public $editMode = false;
    public $commentId;
    public $isDisliked;


    public function mount($slug)
    {
        $this->slug = $slug;
        $this->posts = Post::where('slug', $slug)->first();
        $this->user = Auth::user();
        $this->posts->increment('views');

    }
    //isLikedBy
    public function isLikedBy(?User $user): bool
    {
        return $user && (bool)$this->likes->where('user_id', $user->id)->where('like', 1)->count();
    }
    //isDislikedBy
    public function isDislikedBy(?User $user): bool
    {
        return $user && (bool)$this->dislike->where('user_id', $user->id)->where('like', 0)->count();
    }



    public function like()
    {
       //check if user is logged in
        if (Auth::check()) {
            //check if user has already liked the post
            if ($this->isLikedBy(Auth::user())) {
                //if user has already liked the post, unlike it
                $this->posts->likes()->where('user_id', Auth::user()->id)->delete();
                $this->isLiked = false;
            } else {
                //if user has not liked the post, like it
                $this->posts->likes()->create([
                    'user_id' => Auth::user()->id,
                    'like' => 1,
                    'dislike' => 0,
                ]);
                $this->isLiked = true;
            }
        } else {
            //if user is not logged in, redirect to login page
            return redirect()->route('login');
        }
    }

    public function dislike()
    {
        //check if user is logged in
        if (Auth::check()) {
            //check if user has already disliked the post
            if ($this->isDislikedBy(Auth::user())) {
                //if user has already disliked the post, undislike it
                $this->posts->likes()->where('user_id', Auth::user()->id)->delete();
                $this->isDisliked = false;
            } else {
                //if user has not disliked the post, dislike it
                $this->posts->likes()->create([
                    'user_id' => Auth::user()->id,
                    'like' => 0,
                    'dislike' => 1,
                ]);
                $this->isDisliked = true;
            }
        } else {
            //if user is not logged in, redirect to login page
            return redirect()->route('login');
        }
    }

    //comment
    public function addComment()
    {
        $this->validate([
            'comment' => 'required',
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->posts->id,
            'comment' => $this->comment,
        ]);
        $this->comment = '';
        $this->comments = Comment::where('post_id', $this->posts->id)->where('parent_id', null)->get();
    }

    //edit comment
    public function edit($id)
    {
        $this->updateMode = true;
        $this->editMode = true;
        $comment = Comment::where('id', $id)->first();
        $this->comment = $comment->comment;
        $this->commentId = $id;
    }

    //update comment
    public function update()
    {
        $this->validate([
            'comment' => 'required',
        ]);
        if ($this->commentId) {
            $comment = Comment::find($this->commentId);
            $comment->update([
                'comment' => $this->comment,
            ]);
            $this->updateMode = false;
            $this->editMode = false;
            $this->cancel();
            session()->flash('message', 'Comment Updated Successfully.');
        }
    }

    //cancel edit
    public function cancel()
    {
        $this->updateMode = false;
        $this->editMode = false;
        $this->comment = '';
        $this->commentId = '';
    }

    //delete comment
    public function delete($id)
    {
        if ($id) {
            $comment = Comment::where('id', $id);
            $comment->delete();
            session()->flash('message', 'Comment Deleted Successfully.');
        }
    }




    public function render()
    {
        $this->comments = Comment::where('post_id', $this->posts->id)->where('parent_id', null)->get();
        $this->likes = Like::where('post_id', $this->posts->id)->where('like', 1)->get();
        $this->dislike = Like::where('post_id', $this->posts->id)->where('like', 0)->get();
        $this->isLiked = $this->isLikedBy(Auth::user());
        $this->isDisliked = $this->isDislikedBy(Auth::user());
        return view('livewire.mutual.details-post',[
            'posts' => $this->posts,
            'comments' => $this->comments,
            'likes' => $this->likes,
            'dislike' => $this->dislike,
            'isLiked' => $this->isLiked,
            'isDisliked' => $this->isDisliked,
        ])->layout('layouts.user');
    }
}

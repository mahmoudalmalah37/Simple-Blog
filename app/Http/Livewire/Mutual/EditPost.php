<?php

namespace App\Http\Livewire\Mutual;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $content;
    public $image;
    public $author;
    public $date;
    public $post_id;
    public $post_title;
    public $post_slug;
    public $post_content;
    public $post_image;
    public $post_author;
    public $post_date;

    public function mount($post_id)
    {
        $this->post_id=$post_id;
        $post=Post::find($post_id);
        $this->post_title=$post->title;
        $this->post_slug=$post->slug;
        $this->post_content=$post->content;
        $this->post_image=$post->image;
        $this->post_author=$post->author;
        $this->post_date=$post->date;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    /**
     * @throws ValidationException
     */
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'post_title'=>'required',
            'post_slug'=>'required',
            'post_content'=>'required',
            'post_image'=>'required|image|max:2024|mimes:jpg,jpeg,png',
            'post_author'=>'required',
            'post_date'=>'required',
        ]);
    }

    public function updatePost()
    {
        $post=Post::find($this->post_id);
        $post->title=$this->post_title;
        $post->slug=$this->post_slug;
        $post->content=$this->post_content;

        if ($this->post_image) {
            $imageName = Carbon::now()->timestamp . '.' . $this->post_image->extension();
            $this->post_image->storeAs('Post', $imageName, 'public');
            $post->image = $imageName;
        }
        $post->author=$this->post_author;
        $post->date=$this->post_date;
        $post->save();
        session()->flash('message','Post has been updated successfully!');
    }



    public function render()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('livewire.mutual.edit-post',['posts'=>$posts])->layout('layouts.user');
    }
}

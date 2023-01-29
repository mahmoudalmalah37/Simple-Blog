<?php

namespace App\Http\Livewire\Mutual;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddPost extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $author;
    public $content;
    public $image;
    public $date;

    public function mount()
    {
        $this->date=Carbon::now()->format('Y-m-d');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title,'-');
    }

    public function addPost()
    {

        $this->validate([
            'title' => 'required|unique:posts',
            'image' => 'required|image|mimes:png,jpg,webp|max:2048',
            'content' => 'required|min:20',
        ]);

        try {
            $post = new Post();
            $post->title = $this->title;
            $post->slug = $this->slug;
            $post->author = $this->author;
            $post->author = auth()->user()->name;
            $post->content = $this->content;
            $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
            $this->image->storeAs('Post', $imageName , 'public');
            $post->image = $imageName;
            $post->date = $this->date;
            $post->save();
            session()->flash('message','Post has been created successfully!');
        }catch (ValidationException $e){
            session()->flash('error',$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.mutual.add-post')->layout('layouts.user');
    }
}

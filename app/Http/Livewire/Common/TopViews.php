<?php

namespace App\Http\Livewire\Common;

use App\Models\Post;
use Livewire\Component;

class TopViews extends Component
{
    public $posts;

    //top views
    public function mount()
    {
        $this->posts = Post::orderBy('views','desc')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.common.top-views')->layout('layouts.user');
    }
}

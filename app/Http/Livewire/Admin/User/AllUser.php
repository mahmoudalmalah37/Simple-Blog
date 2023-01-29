<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class AllUser extends Component
{
    //search user
    public $searchTerm;
    public $user_id;


    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
    public function render()
    {
        $search = '%'.$this->searchTerm.'%';
        $users = User::where('name', 'like',$search)
            ->orWhere('email', 'like',$search)
            ->orWhere('utype', 'like',$search)
            ->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.user.all-user',['users'=>$users])->layout('layouts.user');
    }
}

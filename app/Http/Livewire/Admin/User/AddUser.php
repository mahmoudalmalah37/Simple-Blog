<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $utype;

    public function addUser()
    {
        try {
            $this->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
                'utype' => 'required|in:ADM,USR',
            ]);
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->utype = $this->utype;
            $user->save();
            $this->reset();
            session()->flash('message', 'User Added Successfully');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.user.add-user')->layout('layouts.user');
    }
}

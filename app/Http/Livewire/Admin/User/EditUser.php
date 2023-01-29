<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUser extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $email;
    public $password;
    public $utype;
    public $newimage;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $user = User::find($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->utype = $user->utype;
        $this->newimage = $user->profile_photo_path;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'utype' => 'required|in:ADM,USR',
            'newimage' => 'image|max:1024',
        ]);
        try {
            $user = User::find($this->user_id);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->utype = $this->utype;
            if ($this->newimage) {
                $imageName = time() . '.' . $this->newimage->extension();
                $this->newimage->storeAs('profile', $imageName, 'public');
                $user->profile_photo_path = $imageName;
            } else {
                $user->profile_photo_path = $this->newimage;
            }
            if ($this->newimage) {
                if (file_exists('storage/profile/' . $this->newimage) && !empty($this->newimage)) {
                    unlink('storage/profile/' . $this->newimage);
                }
            }
            $user->save();
            session()->flash('message', 'User Updated Successfully');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user')->layout('layouts.user');
    }
}

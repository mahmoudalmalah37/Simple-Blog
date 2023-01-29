<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $email;
    public $password;
    public $newimage;


    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $user = User::find($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->newimage = $user->profile_photo_path;
    }

    /**
     * @throws ValidationException
     */
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'newimage' => 'image|max:1024|nullable',
        ]);
    }

    //update user profile
    public function updateProfile()
    {
        try {
            $this->validate([
                'name' => 'nullable',
                'email' => 'nullable|email',
                'password' => 'nullable',
                'newimage' => 'image|max:1024|nullable',
            ]);
            $user = User::find($this->user_id);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = bcrypt($this->password);
            if ($this->newimage) {
                $imageName = time() . '.' . $this->newimage->extension();
                $this->newimage->storeAs('profile', $imageName, 'public');
                $user->profile_photo_path = $imageName;
            } else {
                $user->profile_photo_path = $this->newimage;
            }
            $user->save();
            session()->flash('message', 'Profile updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.user.edit-profile')->layout('layouts.user');
    }
}

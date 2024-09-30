<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $passwordForm = [
        'password' => '',
        'new_password' => '',
        'confirm_password' => '',
    ];
    public function resetPassword()
    {
        $this->validate([
            'passwordForm.password' => ['required', 'string', 'max:255'],
            'passwordForm.new_password' => ['required', 'string', 'min:6', 'max:50'],
            'passwordForm.confirm_password' => ['required', 'string', 'min:6', 'max:50', 'same:passwordForm.new_password'],
        ], [], [
            'passwordForm.password' => 'password',
            'passwordForm.new_password' => 'new password',
            'passwordForm.confirm_password' => 'confirm password',
        ]);
        $_errors = $this->getErrorBag();
        if (Hash::check($this->passwordForm['password'], auth()->guard('frontend')->user()->password) != 1) {
            $_errors->add('passwordForm.password', 'Current password is incorrect.');
        }
        if (empty($_errors->getMessages())) {
            auth()->guard('frontend')->user()->update([
                'password' => bcrypt($this->passwordForm['new_password']),
            ]);
            $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'You have successfully changed your password.', 'showtime' => 5]);
            $this->reset('passwordForm');
        }
    }
    public function render()
    {
        return view('livewire.user.change-password');
    }
}
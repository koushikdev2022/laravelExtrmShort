<?php

namespace App\Http\Livewire\User\Admin;

use App\Models\UserDetail;
use App\Models\UserMaster;
use Livewire\Component;

class Setting extends Component
{
    public UserMaster $user;

    public function mount($user)
    {
        $this->user = $user;
        UserDetail::firstOrCreate([
            'user_id' => $this->user->id
        ], ['user_id' => $this->user->id]);
    }
    public function render()
    {
        return view('livewire.user.admin.setting');
    }
}
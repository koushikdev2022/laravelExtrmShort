<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Setting extends Component
{

    public function render()
    {
        $tab = request()->has('tab') ? request()->input('tab') : 'profile';
        return view('livewire.user.setting', compact('tab'));
    }
}
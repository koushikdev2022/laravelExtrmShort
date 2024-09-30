<?php

namespace App\Http\Livewire\User;

use App\Models\Notification as ModelsNotification;
use App\Traits\HelperTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Notification extends Component
{
    use WithPagination, HelperTrait;
    public $user_id;

    public function mount()
    {
        $this->user_id = auth()->guard('frontend')->user()->id;
    }

    public function paginationView()
    {
        return 'livewire.search.custom-pagination';
    }

    public function render()
    {
        $data = [];
        $data['notifications'] = ModelsNotification::where(['notifier_id' => $this->user_id, 'status' => '1'])->latest()->paginate(10);
        return view('livewire.user.notification', $data);
    }


    public function remove($id)
    {
        $this->makeAsINACTIVE([$id], 1);
    }
}
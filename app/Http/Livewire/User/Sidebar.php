<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Project;

class Sidebar extends Component
{
    public $user;
    protected $listeners = ['sidebarUpdate' => '$refresh'];

    public function mount()
    {
        $this->user = auth()->guard('frontend')->user();
    }
    public function render()
    {
        $data = [];
        $data['all_project'] = Project::where('user_id', $this->user->id)->count();
        $data['in_progress'] = Project::where(['user_id' => $this->user->id, 'status' => '2'])->count();
        $data['completed'] = Project::where(['user_id' => $this->user->id, 'status' => '3'])->count();
        $data['published'] = Project::where(['user_id' => $this->user->id, 'status' => '1'])->count();
        $data['draft'] = Project::where(['user_id' => $this->user->id, 'status' => '0'])->count();

        return view('livewire.user.sidebar', $data);
    }
}
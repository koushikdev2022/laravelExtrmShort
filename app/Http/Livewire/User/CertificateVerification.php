<?php

namespace App\Http\Livewire\User;

use App\Models\UserDocument;
use App\Models\UserMaster;
use App\Traits\HelperTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CertificateVerification extends Component
{
    use HelperTrait, WithFileUploads;
    public UserMaster $user;
    public $verification_model;
    public $showInternet = false;
    public $form_step = 0;
    public $document_title;
    public $photo;
    public $photo_label = 'Only doc, docx, pdf, txt file';

    public function updatedPhoto()
    {
        // You can do whatever you want to do with $this->files here
        $this->validate([
            'photo' => 'file|mimes:jpeg,png,jpg,pdf,bmp|max:3072'
        ]);
        $this->photo_label = $this->photo->getClientOriginalName();
    }
    public function mount()
    {
        $this->user = auth()->guard('frontend')->user();
        // $this->verification_model = $this->user->verification;
    }
    public function render()
    {
        $data = [];
        $data['certificates'] = UserDocument::where(['user_id' => $this->user->id, 'document_type' => UserDocument::CERTIFICATES])->get();
        return view('livewire.user.certificate-verification', $data);
    }

    public function save()
    {
        $rules = [
            'document_title' => 'required|max:250',
            'photo' => 'required|mimes:jpeg,png,jpg,pdf,bmp|max:3072',
        ];
        $validate = $this->validate($rules);
        $img_name = Str::random(16) . '.' . $this->photo->getClientOriginalExtension();
        $this->photo->storeAs('uploads/frontend/documents/', $img_name, 'public');
        $validate['file_name'] = $img_name;
        $validate['user_id'] = $this->user->id;
        $validate['document_type'] = UserDocument::CERTIFICATES;
        $model = UserDocument::create($validate);
        ///Notification 
        $this->makeNotification([
            'notifier_id' => 1,
            'from_id' => $this->user->id,
            'message' => 'Recently ' . $this->user->name() . ' upload ' . $model->document_title . ' certificate for verification.',
            'url' => url('admin/user-documents/' . base64_encode($model->id)),
        ]);
        //
        $this->showInternet = false;
        $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'Your document upload successfully.Waiting for verification...', 'showtime' => 5]);
    }

    public function triggershow()
    {
        $this->showInternet = !$this->showInternet;
    }
}
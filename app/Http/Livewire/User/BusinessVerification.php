<?php

namespace App\Http\Livewire\User;

use App\Models\UserDocument;
use App\Models\UserMaster;
use App\Traits\HelperTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class BusinessVerification extends Component
{
    use HelperTrait, WithFileUploads;
    public UserMaster $user;
    public $verification_model;
    public $showBusisnessReg = false;
    public $showPremisesPhoto = false;
    public $showInternet = false;
    public $form_step = 0;
    public $document_type;
    public $photo;
    public $photo_label = 'Only doc, docx, pdf, txt file';

    public function updatedPhoto()
    {
        // You can do whatever you want to do with $this->files here
        $rules = [];
        if ($this->form_step == 6) {
            $rules = [
                'photo' => 'required|mimes:doc,docx,pdf|max:10240',
            ];
        } elseif ($this->form_step == 7) {
            $rules = [
                'photo' => 'required|mimes:jpeg,png,jpg,bmp|max:3072',
            ];
        } elseif ($this->form_step == 8) {
            $rules = [
                'photo' => 'required|mimes:jpeg,png,jpg,bmp,pdf|max:3072',
            ];
        }
        $this->validate($rules);
        $this->photo_label = $this->photo->getClientOriginalName();
    }


    public function mount()
    {
        $this->user = auth()->guard('frontend')->user();
        $this->verification_model = $this->user->verification;
    }

    public function render()
    {
        $data = [];
        // if ($this->showBusisnessReg) {
        $data['document_upload_reg'] = UserDocument::where(['user_id' => $this->user->id, 'document_type' => UserDocument::BUSINESS_REG, ['status', '<>', '3']])->first();
        // }
        // if ($this->showPremisesPhoto) {

        $data['document_upload_premises'] = UserDocument::where(['user_id' => $this->user->id, 'document_type' => UserDocument::PREMISES_PHOTO, ['status', '<>', '3']])->first();
        // }
        // if ($this->showInternet) {
        $data['document_upload_internet'] = UserDocument::where(['user_id' => $this->user->id, 'document_type' => UserDocument::INTERNET_SPEED, ['status', '<>', '3']])->first();
        // }
        return view('livewire.user.business-verification', $data);
    }

    public function save($step)
    {
        $rules = [];
        $input = [];
        $file_step_name = '';
        if ($step == 6) {
            $rules = [
                'photo' => 'required|mimes:doc,docx,pdf|max:10240',
            ];
            $file_step_name = 'business registration';
            $input['business_registration'] = '0';
        } elseif ($step == 7) {
            $rules = [
                'photo' => 'required|mimes:jpeg,png,jpg,bmp|max:3072',
            ];
            $file_step_name = 'premises photo';
            $input['premises_photo'] = '0';
        } elseif ($step == 8) {
            $rules = [
                'photo' => 'required|mimes:jpeg,png,jpg,bmp,pdf|max:3072',
            ];
            $file_step_name = 'internet speed & IP address';
            $input['internet_speed'] = '0';
        }
        $validate = $this->validate($rules);
        $img_name = Str::random(16) . '.' . $this->photo->getClientOriginalExtension();
        $this->photo->storeAs('uploads/frontend/documents/', $img_name, 'public');
        $validate['file_name'] = $img_name;
        $validate['user_id'] = $this->user->id;
        $validate['document_type'] = $step;
        $model = UserDocument::create($validate);
        $this->verification_model = tap($this->verification_model)->update($input);
        ///Notification 
        $this->makeNotification([
            'notifier_id' => 1,
            'from_id' => $this->user->id,
            'message' => 'Recently ' . $this->user->name() . ' upload document for ' . $file_step_name . ' verification.',
            'url' => url('admin/user-documents/' . base64_encode($model->id)),
        ]);
        //
        $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'Your document upload successfully.Waiting for verification...', 'showtime' => 5]);
    }

    public function triggershow($step)
    {
        $this->form_step = $step;
        if ($step == 6) {
            $this->photo_label = 'Only doc, docx, pdf file';
            $this->showBusisnessReg = !$this->showBusisnessReg;
            $this->showPremisesPhoto = false;
            $this->showInternet = false;
        } elseif ($step == 7) {
            $this->photo_label = 'Only jpeg, png, jpg, gif, svg';
            $this->showPremisesPhoto = !$this->showPremisesPhoto;
            $this->showBusisnessReg = false;
            $this->showInternet = false;
        } elseif ($step == 8) {
            $this->photo_label = 'Only doc, docx, pdf, txt file';
            $this->showInternet = !$this->showInternet;
            $this->showPremisesPhoto = false;
            $this->showBusisnessReg = false;
        }
    }
}
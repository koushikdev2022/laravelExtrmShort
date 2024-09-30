<?php

namespace App\Http\Livewire\User;

use App\Models\UserDocument;
use App\Models\UserMaster;
use App\Traits\HelperTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class BusinessAuditVerification extends Component
{
    use HelperTrait, WithFileUploads;
    public UserMaster $user;
    public $verification_model;
    public $showInternet = false;
    public $form_open = false;
    public $contact_name;
    public $contact_email;
    public $contact_phone;
    public $address;
    public $country;
    public $countries;
    public $schedule_date;

    public function mount()
    {
        $this->user = auth()->guard('frontend')->user();
        $this->verification_model = $this->user->verification;
        $this->countries = $this->getAllCountry();
    }

    public function render()
    {
        $data = [];
        $data['audit_upload'] = $audit_upload = UserDocument::where(['user_id' => $this->user->id, 'document_type' => UserDocument::BUSINESS_AUDIT])->latest()->first();
        $this->country = $this->user->country;
        if (isset($audit_upload->country)) {
            $this->country = $audit_upload->country;
            $this->contact_name = $audit_upload->contact_name;
            $this->contact_email = $audit_upload->contact_email;
            $this->contact_phone = $audit_upload->contact_phone;
            $this->address = $audit_upload->address;
            $this->schedule_date = $audit_upload->schedule_date;
        }
        return view('livewire.user.business-audit-verification', $data);
    }

    public function save()
    {
        $rules = [
            'country' => 'required',
            'contact_name' => 'required|max:250',
            'contact_email' => 'required|email|max:250',
            'contact_phone' => 'required|digits_between:10,15',
            'address' => 'required|max:300',
            'schedule_date' => 'required|date_format:Y-m-d|after:today',
        ];
        $validate = $this->validate($rules);
        $validate['user_id'] = $this->user->id;
        $validate['document_type'] = UserDocument::BUSINESS_AUDIT;
        $model = UserDocument::updateOrCreate([
            'user_id' => $validate['user_id'], 'document_type' => $validate['document_type']
        ], $validate);
        // $model = UserDocument::create($validate);
        $this->verification_model = tap($this->verification_model)->update([
            'business_audit' => '0'
        ]);
        ///Notification 
        $this->makeNotification([
            'notifier_id' => 1,
            'from_id' => $this->user->id,
            'message' => 'Recently ' . $this->user->name() . ' upload document for business audit verification.',
            'url' => url('admin/user-documents/' . base64_encode($model->id)),
        ]);
        //
        $this->triggershow();
        $modaltitle = 'Message Successfull !';
        $modalpara = 'Thank you for submitting the Business Audit Contact Form and expressing your interest. You will receive an email in the next few days from one of our staff, to schedule your Business Audit.';
        $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'showmodalmsg' => true, 'modaltitle' => $modaltitle, 'modaldetail' => $modalpara, 'showtime' => 5]);
    }

    public function triggershow()
    {
        $this->showInternet = !$this->showInternet;
    }
    public function formOpen()
    {
        $this->showInternet = !$this->showInternet;
        $this->form_open = !$this->form_open;
    }
}
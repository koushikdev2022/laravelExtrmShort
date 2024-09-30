<?php

namespace App\Http\Livewire\User;

use App\Models\UserDocument;
use App\Models\UserMaster;
use App\Models\UserVerification;
use App\Traits\HelperTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Verification extends Component
{
    use HelperTrait, WithFileUploads;

    public UserMaster $user;
    public $verification_model;
    public $showIdentityFrm = false;
    public $showIdentityFrmFirst = true;
    public $showDocumentFrm = false;
    public $showDocumentFrmFirst = true;
    public $document_type;
    public $front_photo;
    public $back_photo;
    public $photo;
    public $cv_doc;
    public $qualification_certificate;
    public $experience_certificate;
    public $photo_label = 'Only jpg, jpeg, png file';

    public function updated($name, $value)
    {
        if (in_array($name, ['front_photo', 'back_photo', 'photo'])) {
            // You can do whatever you want to do with $this->files here
            $this->validate([
                $name => 'file|mimes:jpeg,png,jpg,gif,svg|max:10240', // 10MB Max
            ]);
            // $this->photo_label = $this->photo->getClientOriginalName();
        }
    }


    // protected $rules = [
    //     'document_type' => 'required|numeric',
    //     'front_photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
    //     'back_photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
    //     'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
    // ];


    public function mount()
    {
        $this->user = auth()->guard('frontend')->user();
        $this->verification_model = $this->user->verification;

    }

    public function render()
    {
        $data = [];
        if ($this->showIdentityFrm) {
            $data['documents'] = $this->getUserDocumentType();
            $data['user_document'] = UserDocument::where(['user_id' => $this->user->id, ['status', '<>', '3']])
                ->whereNotIn('document_type', ['6', '7', '8', '9', '10'])->first();
            if (!empty($data['user_document']) && $data['user_document']->status === '1') {
                $data['last_rejected_model'] = NULL;
            } else {
                $data['last_rejected_model'] = UserDocument::where(['user_id' => $this->user->id, 'status' => "3"])->whereNotIn('document_type', ['6', '7', '8', '9', '10'])->latest()->first();
            }
        }

        return view('livewire.user.verification', $data);
    }

    public function savefirstfrm()
    {
        $validate = $this->validate([
            'front_photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'back_photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        ///Store Front Photo
        $front_photo_file_name = Str::random(16) . '.' . $this->front_photo->getClientOriginalExtension();
        $this->front_photo->storeAs('uploads/frontend/documents/', $front_photo_file_name, 'public');
        UserDocument::updateOrCreate(['user_id' => $this->user->id, 'document_type' => '2', 'status' => '0', 'which_document' => 'front'], [
            'file_name' => $front_photo_file_name
        ]);
        ///Store Rear Photo
        $back_photo_file_name = Str::random(16) . '.' . $this->back_photo->getClientOriginalExtension();
        $this->back_photo->storeAs('uploads/frontend/documents/', $back_photo_file_name, 'public');
        UserDocument::updateOrCreate(['user_id' => $this->user->id, 'document_type' => '2', 'status' => '0', 'which_document' => 'rear'], [
            'file_name' => $back_photo_file_name
        ]);
        ///Notification 
        $this->makeNotification([
            'notifier_id' => 1,
            'from_id' => $this->user->id,
            'message' => 'Recently ' . $this->user->name() . ' upload document for identity verification.',
            'url' => url('admin/admin-viewuser/' . base64_encode($this->user->id)),
        ]);
        //
        $this->showfirstfrm();
        // $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'Your document upload successfully.Waiting for verification...', 'showtime' => 5]);
    }
    public function savefinalfrm()
    {
        $validate = $this->validate([
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $img_name = Str::random(16) . '.' . $this->photo->getClientOriginalExtension();
        $this->photo->storeAs('uploads/frontend/documents/', $img_name, 'public');
        UserDocument::updateOrCreate(['user_id' => $this->user->id, 'document_type' => '2', 'status' => '0', 'which_document' => 'selfi'], [
            'file_name' => $img_name
        ]);

        $this->verification_model = tap($this->verification_model)->update([
            'identity' => '0'
        ]);
        //
        // $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'Your document upload successfully.Waiting for verification...', 'showtime' => 5]);

        $modaltitle = 'ID Verification Completed';
        $modalpara = 'Thank you for completing the Verification. Once your documentation will be
                            reviewed you will be notified of the result of the verification.Please mind that we might request additional information if verification is incomplete or
                            the information provided is not clear.';
        $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'showmodalmsg' => true, 'modaltitle' => $modaltitle, 'modaldetail' => $modalpara, 'showtime' => 5]);


        $this->triggershowIdentityFrm();
    }

    public function savefirstDocumentfrm()
    {
        $validate = $this->validate([
            'cv_doc' => 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:10240',
            'qualification_certificate' => 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:10240',
            'experience_certificate' => 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:10240',
        ]);
        ///Store Front Photo
        $cv_doc_file_name = Str::random(16) . '.' . $this->cv_doc->getClientOriginalExtension();
        $this->cv_doc->storeAs('uploads/frontend/documents/', $cv_doc_file_name, 'public');
        UserDocument::updateOrCreate(['user_id' => $this->user->id, 'document_type' => '11', 'status' => '0', 'which_document' => 'CV'], [
            'file_name' => $cv_doc_file_name
        ]);
        ///Store Rear Photo
        $qualification_certificate_file_name = Str::random(16) . '.' . $this->qualification_certificate->getClientOriginalExtension();
        $this->qualification_certificate->storeAs('uploads/frontend/documents/', $qualification_certificate_file_name, 'public');
        UserDocument::updateOrCreate(['user_id' => $this->user->id, 'document_type' => '12', 'status' => '0', 'which_document' => 'Qualification Certificate'], [
            'file_name' => $qualification_certificate_file_name
        ]);
        ///Store Rear Photo
        $experience_certificate_file_name = Str::random(16) . '.' . $this->experience_certificate->getClientOriginalExtension();
        $this->experience_certificate->storeAs('uploads/frontend/documents/', $experience_certificate_file_name, 'public');
        UserDocument::updateOrCreate(['user_id' => $this->user->id, 'document_type' => '13', 'status' => '0', 'which_document' => 'Experience Certificate'], [
            'file_name' => $experience_certificate_file_name
        ]);
        ///Notification 
        $this->makeNotification([
            'notifier_id' => 1,
            'from_id' => $this->user->id,
            'message' => 'Recently ' . $this->user->name() . ' upload document for documents verification.',
            'url' => url('admin/admin-viewuser/' . base64_encode($this->user->id)),
        ]);
        //
        $modaltitle = 'Douments Verification Completed';
        $modalpara = 'Thank you for completing the Verification. Once your documentation will be
                            reviewed you will be notified of the result of the verification.Please mind that we might request additional information if verification is incomplete or
                            the information provided is not clear.';
        $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'showmodalmsg' => true, 'modaltitle' => $modaltitle, 'modaldetail' => $modalpara, 'showtime' => 5]);

        $this->triggershowDocumentFrm();
    }

    public function triggershowIdentityFrm()
    {
        $this->showIdentityFrm = !$this->showIdentityFrm;
    }

    public function triggershowDocumentFrm()
    {
        $this->showDocumentFrm = !$this->showDocumentFrm;
    }

    public function showfirstDocumentfrm()
    {
        $this->showDocumentFrmFirst = !$this->showDocumentFrmFirst;
    }

    public function showfirstfrm()
    {
        $this->showIdentityFrmFirst = !$this->showIdentityFrmFirst;
    }
}
<?php

namespace App\Http\Livewire\User\Admin;

use App\Helpers\Twilio;
use Livewire\Component;
use App\Models\Language;
use App\Models\UserMaster;
use App\Models\UserDetail;
use App\Models\Skill;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Traits\HelperTrait;

class PersonalDetail extends Component
{
    use WithFileUploads, HelperTrait;

    public $profileform = [
        'type_id' => '',
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'dob' => '',
        'country' => '',
        'city' => '',
        'phone' => '',
        'individual_freelancer' => '',
        'company_employee' => '',
        'employee_company_name' => '',
        'employee_company_logo' => '',
        'client_company_name' => '',
        'status' => '',
        'flag_reason' => '',
        // 'phone_verified' => '',
        'address_line1' => '',
        'address_line2' => '',
        'latitude' => '',
        'longitude' => '',
    ];

    public $address_line1;
    public $latitude;
    public $longitude;

    public $profile_picture;
    public $employee_company_logo;

    public $detailform = [
        
        // 'address_line1' => '',
        'category_id' => '',
        'about' => '',
        // 'availablity'=>'',
        // 'outsourcing_type' => '1',
        // 'available_on_weekend' => '',
        'languages' => '',
        'educations' => array(),
        'edus' => array(),
        'services' => array(),
        // 'tools' =>  array(),
    ];
    public $skills = [];
    public $user_skills=[];
    public $user_categories = [];
    public $languages;
    public $availablity;
    public $countries;
    // public $availabilities;
    // public $professionTypes;
    public $category_id;
    public $categories;
    public $user;
    public $user_detail;
    //
    // public $is_new_phone = false;
    // public $new_phone = '';
    // public $old_new_phone = '';
    // public $new_phone_msg = '';
    // public $otp_enable = false;
    // public $verify_needed = false;
    // public $oo = '';
    // public $otp = '';
    //


    protected $listeners = ['getLatitudeForInput','getLogitudeForInput','getAddressForInput'];

    public function getLatitudeForInput($value)
    {
        if(!is_null($value))
            $this->latitude = $value; 
    }
    public function getLogitudeForInput($value)
    {
        if(!is_null($value))
            $this->longitude = $value;
          
    }
    public function getAddressForInput($value)
    {
        if(!is_null($value))
            $this->address_line1 = $value;
    }

    protected $rules = [
        'profileform.first_name' => 'required|min:3|max:100',
        'profileform.last_name' => 'required|min:3|max:100',
        // 'profileform.email' => 'required|email|max:100',
        'profileform.country' => 'required',
        'profileform.phone' => 'nullable|numeric|digits_between:10,15',
        // 'detailform.category_id' => 'required',
        // 'detailform.hours' => 'required',
        'detailform.educations.*.lavel' => 'nullable',
        'detailform.edus.*.lavel_of_education' => 'nullable',
        // 'detailform.services.*' => 'nullable',
        // 'detailform.availablity.*' => 'required',
        // 'detailform.headline' => 'nullable|max:250',
        'detailform.about' => 'nullable|min:100|max:5000',
        'profile_picture' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ];

    protected $validationAttributes = [
        'profile_picture' => 'profile picture',
        'profileform.first_name' => 'first name',
        'profileform.last_name' => 'last name',
        // 'profileform.email' => 'email',
        'profileform.address_line1' => 'address',
        'profileform.phone' => 'phone',
        'profileform.country' => 'country',
        // 'detailform.category_id' => 'profession type',
        'detailform.educations.*.lavel' => 'level',
        'detailform.edus.*.lavel_of_education' => 'lavel_of_education',
        // 'detailform.services.*' => 'service',
        // 'detailform.hours' => 'availability',
        // 'detailform.headline' => 'headline',
        // 'detailform.availablity.*.lavel' => 'availablity',
        'detailform.about' => 'description',
        // 'detailform.tools.*' => 'tool',
    ];

    public function mount()
    {
       

        $this->languages = Language::get();
        $this->countries = $this->getAllCountry();
        $this->availabilities = $this->getAvailabilityTypes();
        $this->professionTypes = $this->getOutsourcingTypes();
        $this->categories = Category::with('translation')->whereNUll('parent_id')->where('status', '1')->get();
        $this->skills = Category::with('translation')->where('status', '1')->get();
        
        $this->user_detail = UserDetail::firstOrCreate([
            'user_id' => $this->user->id
        ], ['user_id' => $this->user->id]);

        $this->user = $this->user;

        foreach (array_keys($this->profileform) as $v) {
            if (isset($this->user->{$v})) {
                $this->profileform[$v] = old($v, request()->query($v)) ?: $this->user->{$v};
            }
        }
        foreach (array_keys($this->detailform) as $v) {
            if (isset($this->user_detail->{$v})) {
                $this->detailform[$v] = old($v, request()->query($v)) ?: $this->user_detail->{$v};
            }
        }
        
        if (empty($this->user_detail->educations)) {
            $this->detailform['educations'][] = $this->educactionArray();

        }

        // $this->fill([ 
        //     'detailform.edus' => json_decode($this->user_detail->edus),
        // ]);

        // dd($this->user_detail->edus);

        // dd($this->user_detail->educations);

        if (empty($this->user_detail->edus)) {
            $this->detailform['edus'][] = $this->edArray();
        }

        if (empty($this->user_detail->services)) {
            $this->detailform['services'][] = [];
        }
        if (!empty($this->user_detail->category_id)) {
            $this->user_categories = explode(',', $this->user_detail->category_id);
        }
        if (!empty($this->user_detail->skill_id)) {
            $this->user_skills = explode(',', $this->user_detail->skill_id);
        }

        if (!empty($this->user_detail->availablity)) {
            $this->availablity = explode(',', $this->user_detail->availablity);
        }

        if(!empty($this->user))
        {
            $this->fill([
                'address_line1' => $this->user->address_line1,
            ]);
        }

        

        // if (empty($this->user_detail->tools)) {
        //     $this->detailform['tools'][] = [];
        // }
        // $user_skills = $this->user->skills()->pluck('skill_id');
        // if (sizeof($user_skills) > 0) {
        //     $this->user_skills = [];
        //     foreach ($user_skills as $user_skill) {
        //         array_push($this->user_skills, $user_skill);
        //     }
        // }
        // if (!empty($this->user->phone)) {
        //     $this->verify_needed = $this->user->phone_verified === '0' ? true : false;
        // }
    }

    public function changeEvent($value)
    {
        dd($value);
        $this->city_id = $value;
    }

    public function render()
    {
        // if (!empty($this->user_categories)) {
        //     $this->skills = [];
        //     foreach ($this->user_categories as $user_cat) {
        //         $this->skills[$user_cat]['skills'] = Category::select('categories.id', 'translation_categories.category_name')
        //             ->leftJoin('translation_categories', 'translation_categories.category_id', 'categories.id')
        //             ->where('categories.parent_id', $user_cat)->where('translation_categories.lang_code', 'en')
        //             ->where('categories.status', '1')->orderBy('translation_categories.category_name', 'ASC')->get();
        //         $ca = Category::with('translation')->find($user_cat);
        //         $this->skills[$user_cat]['name'] = isset($ca->translation->category_name) ? $ca->translation->category_name : '';
        //     }
        // } elseif (empty($this->user_categories)) {
        //     $this->skills = [];
        //     $this->user_skills = [];
        // }
        $data = [];
        // dd($this->user_categories);
        if (!empty($this->user_categories)) {
            $this->skills = $this->getSkillBy($this->user_categories);
            // dd($data['skills']);
        } else {
            $this->skills = [];
        }
        $data['user'] = $this->user;
        return view('livewire.user.admin.personal-detail',$data);
    }

    private function educactionArray()
    {
        return [
            'lavel' => '',
            'from_date' => '',
            'to_date' => '',
            'is_present' => '',
            'description' => '',
        ];
    }

    private function edArray()
    {
        return [
            'lavel_of_education' => '',
            'school' => '',
            'school_location' => '',
            'is_edu_present' => '',
            'from_edu_date' => '',
            'to_edu_date' => '',
        ];
    }

    public function add($type)
    {
        switch ($type) {
            case 'education':
                array_push($this->detailform['educations'], $this->educactionArray());
                break;
            case 'ed':
                array_push($this->detailform['edus'], $this->edArray());
                break;
            case 'service':
                array_push($this->detailform['services'], []);
                break;
            case 'tool':
                array_push($this->detailform['tools'], []);
                break;
        }
    }

    public function remove($type, $i)
    {
        switch ($type) {
            case 'education':
                unset($this->detailform['educations'][$i]);
                break;
            case 'ed':
                unset($this->detailform['edus'][$i]);
                break;
            case 'service':
                unset($this->detailform['services'][$i]);
                break;
            case 'tool':
                unset($this->detailform['tools'][$i]);
                break;
        }
    }

    public function store()
    {
        $this->validate();
        $_errors = $this->getErrorBag();
        $model = UserMaster::where('email', '=', $this->profileform['email'])->where('id', '<>', $this->user->id)->where('status', '<>', '3')->count();
    
        // if ($model !== 0) {
        //     $_errors->add('profileform.email', 'This Email is already use.');
        // }
        // if ($this->verify_needed) {
        //     $_errors->add('profileform.phone', 'This phone verify is needed.');
        // }

        if (empty($_errors->getMessages())) {
            $flag = 0;
            $response = ['type' => 'success', 'message' => 'Your information saved successfully.', 'showtime' => 5];
            if ($this->profile_picture) {
                $this->profileform['profile_picture'] = $this->AvatarUpload($this->profile_picture);
                $flag = 1;
            }
            // if ($this->employee_company_logo) {
            //     $this->profileform['employee_company_logo'] = $this->AvatarCompanyLogoUpload($this->employee_company_logo);
            //     $flag = 1;
            // }


            if (empty($this->profileform['dob'])) {
                $this->profileform['dob'] = NULL;
            }

            if (!empty($this->latitude)) {
                $this->profileform['latitude'] = $this->latitude;
            }
            if (!empty($this->longitude)) {
                $this->profileform['longitude'] = $this->longitude;
            }
            if (!empty($this->address_line1)) {
                $this->profileform['address_line1'] = $this->address_line1;
            }


            $this->user = tap($this->user)->update($this->profileform);
            
            $detailsform = $this->detailform;

            if (!empty($this->user_categories)) {
                $detailsform['category_id'] = implode(',', $this->user_categories);
            }

            if (!empty($this->user_skills)) {
                $detailsform['skill_id'] = implode(',', $this->user_skills);
            }
            if (!empty($this->availablity)) {
                $detailsform['availablity'] = implode(',', $this->availablity);
            }
            // echo '<pre>';
            // print_r($this->detailform['educations']);
            // echo '</pre>';
            // exit();
            // dd($detailsform);
            $this->user_detail = tap($this->user_detail)->update($detailsform);
            // $this->user->skills()->sync($this->user_skills);
            if ($flag === 1) {
                $response['thumb'] = $this->user->thumb;
            }
            // Verification 
            if (!empty($this->user->email) && !empty($this->user->country) && !empty($this->user_detail->services) && !empty($this->user_detail->educations) && !empty($this->user_detail->edus)) {
                $this->user->update([
                    'user_id' => $this->user->id,
                    'profile' => '1',
                ]);
            } else {
                $this->user->update([
                    'user_id' => $this->user->id,
                    'profile' => '0',
                ]);
            }

            $this->dispatchBrowserEvent('livealert', $response);
            $this->emit('sidebarUpdate');
            // $this->reset();
        }
    }

    // public function addPhone()
    // {
    //     $this->is_new_phone = true;
    // }

    // public function sendOtp()
    // {
    //     if (empty($this->new_phone)) {
    //         $this->new_phone_msg = 'Please provide your phone number.';
    //     } elseif (!is_numeric($this->new_phone)) {
    //         $this->new_phone_msg = 'Please give proper number with country code without plus sign.';
    //     } elseif (strlen($this->new_phone) < 10 || strlen($this->new_phone) > 15) {
    //         $this->new_phone_msg = 'Please give proper number with country code without plus sign.';
    //     } else {
    //         $this->new_phone_msg = '';
    //         $this->old_new_phone = $this->new_phone;
    //         $this->oo = Str::random(8);
    //         $message_client = (new Twilio)->sendMessage('+' . $this->new_phone, $this->oo);
    //         if ($message_client['status'] === 200) {
                
    //             $this->otp_enable = true;
    //             $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'A otp send to your phone for verification.']);
    //         } else {
    //             $this->new_phone_msg = $message_client['msg'];
    //             // $this->new_phone_msg = 'Something went wrong.Please try again later.';
    //         }
    //     }
    // }


    // public function verifyOtp()
    // {
    //     if (empty($this->otp)) {
    //         $this->new_phone_msg = 'Please provide your otp.';
    //     } elseif ($this->old_new_phone !== $this->new_phone) {
    //         $this->new_phone_msg = 'Phone number changed.';
    //     } elseif ($this->oo !== $this->otp) {
    //         $this->new_phone_msg = 'Your otp is wrong.';
    //     } else {
    //         $this->profileform['phone'] = $this->new_phone;
    //         $this->profileform['phone_verified'] = '1';
    //         $this->user->update([
    //             'phone' => $this->new_phone
    //         ]);
    //         $this->user->verification()->update([
    //             'user_id' => $this->user->id,
    //             'identity' => '1',
    //         ]);
    //         $this->new_phone_msg = '';
    //         $this->oo = '';
    //         $this->is_new_phone = false;
    //         $this->verify_needed = false;
    //         $this->otp_enable = false;
    //         $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'Your phone verification done successfully.']);
    //     }
    // }


    private function AvatarCompanyLogoUpload($file1)
    {
        $img_name = NULL;
        if ($file1) {
            $img_name = Str::random(16) . '.' . $file1->getClientOriginalExtension();
            $destination_path = 'storage/uploads/frontend/company_logo';
            $file1->storeAs('uploads/frontend/company_logo/original/', $img_name, 'public');
            Image::make(public_path($destination_path . '/original/' . $img_name))
                ->resize(
                    215,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(public_path($destination_path . '/preview/') . $img_name);
            Image::make(public_path($destination_path . '/original/' . $img_name))
                ->resize(
                    60,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(public_path($destination_path . '/thumb/') . $img_name);
        }
        return $img_name;
    }
    private function AvatarUpload($file)
    {
        $img_name = NULL;
        if ($file) {
            $img_name = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $destination_path = 'storage/uploads/frontend/profile_picture';
            $file->storeAs('uploads/frontend/profile_picture/original/', $img_name, 'public');
            Image::make(public_path($destination_path . '/original/' . $img_name))
                ->resize(
                    215,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(public_path($destination_path . '/preview/') . $img_name);
            Image::make(public_path($destination_path . '/original/' . $img_name))
                ->resize(
                    60,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(public_path($destination_path . '/thumb/') . $img_name);
        }
        return $img_name;
    }
}
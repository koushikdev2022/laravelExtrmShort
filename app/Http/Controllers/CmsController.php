<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\BecomePartnerRequest;
use App\Http\Requests\AskQuestionRequest;
use App\Http\Requests\CareersRequest;
use Carbon\Carbon;
use App\Models\Settings;
use App\Models\Cms;
use App\Models\CmsTranslate;

use App\Models\Blog;
use App\Models\Career;
use App\Models\Category;
use App\Models\FaqTranslate;
use App\Models\Faq;
use App\Models\ContactUs;
use App\Models\BacomePartner;
use App\Models\Question;
use App\Models\QuestionImage;
use App\Models\UserMaster;
use App\Models\Notification;
use App\Models\Multilingual;


use App\Traits\HelperTrait;

class CmsController extends Controller
{
    use HelperTrait;
    public function terms()
    {
        $data = [];
        if (session()->has('locale')) {
            $lang = session()->get('locale');
            $data['model'] = CmsTranslate::where('slug', 'terms_conditions')->where('language_code', $lang)->first();
        } else {
            $data['model'] = CmsTranslate::where('slug', 'terms_conditions')->where('language_code', 'en')->first();
        }
        // $data['model'] = Cms::where('slug','terms_conditions')->where('language_code','en')->first();
        return view('cms.cookie', $data);
    }

    public function about()
    {
        $data = [];
     
         $data['model'] = Cms::where('slug','about_us')->first();
        return view('cms.about', $data);
    }

    public function privacy_policy()
    {
        $data['model'] = Cms::where('slug','privacy-policy')->first();
        return view('cms.privacy-policy', $data);
    }

    public function terms_and_conditions()
    {
        $data = [];
        $data['model'] = Cms::where('slug','term & condition')->first();
        return view('cms.terms-and-conditions', $data);
    }

    public function user_agreement()
    {
        $data = [];
        if (session()->has('locale')) {
            $lang = session()->get('locale');
            $data['model'] = CmsTranslate::where('slug', 'user_agreement')->where('language_code', $lang)->first();
        } else {
            $data['model'] = CmsTranslate::where('slug', 'user_agreement')->where('language_code', 'en')->first();
        }
        // $data['model'] = Cms::where('slug','about_us')->where('language_code','en')->first();
        return view('cms.user-agreement', $data);
    }

    public function cookie_policy()
    {
        $data = [];
        if (session()->has('locale')) {
            $lang = session()->get('locale');
            $data['model'] = CmsTranslate::where('slug', 'cookie_policy')->where('language_code', $lang)->first();
        } else {
            $data['model'] = CmsTranslate::where('slug', 'cookie_policy')->where('language_code', 'en')->first();
        }
        // $data['model'] = Cms::where('slug','about_us')->where('language_code','en')->first();
        return view('cms.cookie-policy', $data);
    }





    public function testimonials()
    {
        $data = [];
        return view('cms.testimonials', $data);
    }


    public function how_it_works()
    {
        $data = [];
        $data['model'] = Cms::where('slug', 'how_it_works')->first();
        return view('cms.how_it_works', $data);
    }

    public function cookie()
    {
        $data = [];
        if (session()->has('locale')) {
            $lang = session()->get('locale');
            $data['model'] = CmsTranslate::where('slug', 'cookie')->where('language_code', $lang)->first();
        } else {
            $data['model'] = CmsTranslate::where('slug', 'cookie')->where('language_code', 'en')->first();
        }
        // $data['model'] = Cms::where('slug','cookie')->where('language_code','en')->first();
        return view('cms.cookie', $data);
    }

    // public function contact()
    // {
    //     $data = [];
    //     if (session()->has('locale')) {
    //         $lang = session()->get('locale');
    //         $data['model'] = CmsTranslate::where('slug','about_us')->where('language_code',$lang)->first();
    //     }else{
    //         $data['model'] = CmsTranslate::where('slug','about_us')->where('language_code','en')->first();
    //     }
    //     return view('cms.about',$data);
    // }

    public function contact()
    {
        $data = [];
        $data['model'] = Cms::where('slug','contact_us')->first();
        $data['settings'] = Settings::where('module', 'General')->get();
       
        return view('cms.contact', $data);
    }

    public function careers()
    {
        $data = [];
        $data['categories'] = Category::where('parent_id', NULL)->get();
        return view('cms.careers', $data);
    }

    public function post_careers(CareersRequest $request)
    {
        if ($request->ajax()) {

            $data = [];

            $admin_email = Settings::where('slug', '=', 'contact_email')->first();

            $contact = new Career;
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->phone_no = $request->input('phone_no');
            $contact->category_id = $request->input('category_id');
            // $contact->subject = $request->input('subject');
            $contact->message = $request->input('message');
            $contact->created_at = Carbon::now()->toDateTimeString();
            $contact->save();

            if (isset($contact->id)) {
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'PHONE' => ($contact->phone_no != "") ? $contact->phone_no : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->value,
                    'subject' => $contact->subject,
                    'template' => 'contact_us',
                    'data' => ['message' => $email_setting['body']]
                ];

                $this->SendMailBySwiftMailer($email_data);

                $url = Route('careers');
                $data['status'] = "success";
                $data['msg'] = "Thank you for submited careers requested. We will Contact you soon.";
                $data['link'] = $url;
            } else {
                $data['errors']['message'] = "messages.Sorry! some problem is there. Please try again";
                $data['status'] = 422;
            }

            return response()->json($data);
        }
    }

    public function help_and_support()
    {
        $data = [];
        $data['settings'] = Settings::where('module', 'General')->get();
      
        return view('cms.help-and-support', $data);
    }

    public function post_contact_us(ContactUsRequest $request)
    {
        if ($request->ajax()) {
            $data = [];

            $admin_email = Settings::where('slug', '=', 'contact_email')->first();

            $contact = new ContactUs;
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            // $contact->phone_no = $request->input('phone_no');
            $contact->subject = $request->input('subject');
            $contact->message = $request->input('message');
            $contact->created_at = Carbon::now()->toDateTimeString();
            $contact->save();

            if (isset($contact->id)) {
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'PHONE' => ($contact->phone_no != "") ? $contact->phone_no : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->value,
                    'subject' => $contact->subject,
                    'template' => 'contact_us',
                    'data' => ['message' => $email_setting['body']]
                ];

                $this->SendMailBySwiftMailer($email_data);

                $url = Route('contact-us');
                $data['status'] = "success";
                $data['msg'] = "Thank you for contacting us. We will Contact you soon.";
                $data['link'] = $url;
            } else {
                $data['errors']['message'] = "messages.Sorry! some problem is there. Please try again";
                $data['status'] = 422;
            }

            return response()->json($data);
        }
    }

    public function become_a_partner()
    {
        $data = [];
        return view('cms.become_a_partner', $data);
    }

    public function post_become_a_partner(BecomePartnerRequest $request)
    {
        if ($request->ajax()) {
            $data = [];

            $admin_email = Settings::where('slug', '=', 'contact_email')->first();
            $check_user = UserMaster::where('email', '=', $request->email)->first();

            $partner = new BacomePartner;
            $partner->name = $request->input('name');
            $partner->surname = $request->input('surname');
            $partner->company_name = $request->input('company_name');
            $partner->email = $request->input('email');
            $partner->business_phone = $request->input('business_phone');
            $partner->benefit = $request->input('benefit');
            if (isset($check_user)) {
                $partner->is_registered = '1';
            } else {
                $partner->is_registered = '0';
            }
            $partner->created_at = Carbon::now()->toDateTimeString();
            $partner->save();

            if (isset($partner->id)) {
                $input = [];
                $input['user_id'] = 1;
                $input['message'] = $request->name . ' ' . $request->surename . __('messages.wants to become a partner.');
                $input['link'] = Route('admin-viewpartner', ['id' => $partner->id]);
                $input['type'] = '6';
                Notification::create($input);

                $email_setting = $this->get_email_data('become_partner', array('ADMIN' => "Admin", 'NAME' => $partner->name, 'SURNAME' => $partner->surname, 'COMPANY NAME' => $partner->company_name, 'EMAIL' => $partner->email, 'BUSINESS PHONE' => ($partner->business_phone != "") ? $partner->business_phone : 'Not Provided', 'How can we benefit each other' => $partner->benefit));
                $email_data = [
                    'to' => $admin_email->value,
                    'subject' => __('messages.Become A Partner'),
                    'template' => 'become_partner',
                    'data' => ['message' => $email_setting['body']]
                ];

                $this->SendMailBySwiftMailer($email_data);

                $email_setting = $this->get_email_data('automatic_reply', array('NAME' => $partner->name . ' ' . $partner->surname));
                $email_data = [
                    'to' => $partner->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'automatic_reply',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMailBySwiftMailer($email_data);

                $url = Route('become-a-partner');
                $data['status'] = "success";
                $data['msg'] = __('messages.Thank you for Become A Partner. We will Contact you soon.');
                $data['link'] = $url;
            } else {
                $data['errors']['message'] = __('messages.Sorry! some problem is there. Please try again');
                $data['status'] = 422;
            }

            return response()->json($data);
        }
    }

    public function post_ask_a_question(AskQuestionRequest $request)
    {
        if ($request->ajax()) {
            $data = [];

            $admin_email = Settings::where('slug', '=', 'contact_email')->first();

            $check_user = UserMaster::where('email', '=', $request->email)->first();


            $question = new Question;
            $question->name = $request->input('name');
            $question->surename = $request->input('surename');
            $question->email = $request->input('email');
            $question->topic = $request->input('topic');
            $question->message = $request->input('message');
            $question->reply_to_email = $request->input('reply_to_email');
            $question->reply_to_message = $request->input('reply_to_message');
            if (isset($check_user)) {
                $question->is_registered = '1';
            } else {
                $question->is_registered = '0';
            }
            $question->created_at = Carbon::now()->toDateTimeString();
            $question->save();
            // print_r($request->file('image'));
            // exit;
            // if(!empty($request->image))
            // {
            //     foreach ($request->file('image') AS $image) {
            //         $input = [];
            //         $input['question_id'] = $question->id;
            //         $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the file extention
            //         $destinationPath = public_path('storage/uploads/admin/question_image/original/'); //public path folder dir
            //         $image->move($destinationPath, $name);
            //         $input['image'] = $name;
            //         $input['status'] = '1';
            //         QuestionImage::create($input);
            //     }
            // }
            // dd($count);
            // exit;
            if (isset($question->id)) {
                $input = [];
                $input['user_id'] = 1;
                $input['message'] = $request->name . ' ' . $request->surename . ' ' . __('messages.asked a question.');
                $input['link'] = Route('admin-viewquestion', ['id' => $question->id]);
                $input['type'] = '5';
                Notification::create($input);
                $email_setting = $this->get_email_data('ask_question', array('ADMIN' => "Admin", 'NAME' => $question->name, 'SURNAME' => $question->surename, 'EMAIL' => $question->email, 'CATEGORY' => $question->category, 'TOPIC' => $question->topic, 'MESSAGE' => $question->message));
                $email_data = [
                    'to' => $admin_email->value,
                    'subject' => __('messages.Ask A Question'),
                    'template' => 'ask_question',
                    'data' => ['message' => $email_setting['body']]
                ];

                $this->SendMailBySwiftMailer($email_data);

                $email_setting = $this->get_email_data('automatic_reply', array('NAME' => $question->name . ' ' . $question->surename));
                $email_data = [
                    'to' => $question->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'automatic_reply',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMailBySwiftMailer($email_data);

                $url = Route('ask-a-question');
                $data['status'] = "success";
                $data['msg'] = __('messages.Thank you for Ask A Question. We will Contact you soon.');
                $data['link'] = $url;
            } else {
                $data['errors']['message'] = __('messages.Sorry! some problem is there. Please try again');
                $data['status'] = 422;
            }

            return response()->json($data);
        }
    }

    public function ask_question()
    {
        $data = [];
        return view('cms.ask_question', $data);
    }

    public function faq()
    {
        $data = [];
        $data['model'] = Faq::where('status', '1')->get();

        return view('cms.faq', $data);
    }

    public function privacy()
    {
        $data = [];
        if (session()->has('locale')) {
            $lang = session()->get('locale');
            $data['model'] = CmsTranslate::where('slug', 'privacy_policy')->where('language_code', $lang)->first();
        } else {
            $data['model'] = CmsTranslate::where('slug', 'privacy_policy')->where('language_code', 'en')->first();
        }
        // $data['model'] = Cms::where('slug','privacy_policy')->where('language_code','en')->first();
        return view('cms.cookie', $data);
    }

    public function blog()
    {
        $model = Blog::where('status', '1')->paginate(9);
        $latest = Blog::where('status', '1')->where('created_at', '>', now()->subDays(2)->endOfDay())->paginate(12);
        return view('cms.blog', compact('model', 'latest'));
    }

    public function blog_list(Request $r)
    {
        if ($r->ajax()) {
            $response = [];
            $data = [];
            $data['model'] = Blog::where('status', '1')->latest()->paginate(9);
            $view = view('ajax.blog', $data)->render();
            $response['success'] = true;
            $response['content'] = $view;
            return response()->json($response);
        }
    }

    public function blog_details($id)
    {
        $data = [];
        $data['model'] = Blog::find(base64_decode($id));
        $data['latest'] = Blog::where('status', '1')->latest('created_at')->paginate(5);
        return view('cms.blog_details', $data);
    }


    public function loadPost(Request $request)
    {
        if($request->input('search') != ''){
            $data['posts'] = Blog::where('status', '1')->where("title", "LIKE", "%{$request->input('search')}%")->orWhere("description", "LIKE", "%{$request->input('search')}%")->orWhere("category", "LIKE", "%{$request->input('search')}%")->get();
        }else{
            $data['posts'] = Blog::where('status', '1')->latest('created_at')->orderBy('id','desc')->limit(6)->get();
        }
        if (count($data) > 0) {
            $view = view('ajax.loadPost', $data)->render();
        } else {
            $view = '';
        }
        $result['content'] = $view;
        return response()->json($result);
    }
}

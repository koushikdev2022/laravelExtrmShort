<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as AuthSession;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Hybridauth\Exception\Exception;
use Socialite;
use App;
// ************ Requests ************
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Models\{UserMaster, UserStory, Category, Notification, CmsTranslate,ProducingWithUs,Testimonial};
use App\Models\Review;
use Illuminate\Support\Facades\DB;
//use Laravel\Socialite\Facades\Socialite;



class SiteController extends Controller
{
    use HelperTrait;

    protected $providers = [
        'github', 'facebook', 'google', 'twitter'
    ];

    public function index()
    {
        $data = [];
        // $data = UserMaster::with('stories')->where(['user_master.type_id' => '2', 'status' => '1'])->orderBy('id', 'desc')->get();

        $data = DB::table('user_stories')->join('user_master', 'user_stories.user_id', '=', 'user_master.id')
        ->select('user_stories.*', 'user_master.name', 'user_master.profile_picture')->where('user_stories.created_at', '>=', Carbon::now()->subDay())->get();
        $producing = ProducingWithUs::where(['status'=>'1'])->get();
        $testimonials = Testimonial::where(['status'=>'1'])->get();

        return view('site.index', compact('data','testimonials','producing'));
    }

    public function priceChart()
    {
        $data = CmsTranslate::where(['slug'=>'pricing_content','language_code'=>'en'])->orderBy('id','desc')->first();
        return view('site.priceChart',compact('data'));
    }


    public function signup()
    {
        $data = [];
        if (!Auth()->guard('frontend')->guest()) {
            return redirect()->route('feed');
        }
        return view('site.signup', $data);
    }

    public function registration_submit(RegistrationRequest $request)
    {
        if ($request->ajax()) {
            $data = [];

            $input['type_id'] = '2';
            $input['name'] = $request->input('name');
            $input['email'] = $request->input('email');
            // $input['address_line1'] = $request->input('address_line2');
            // $input['latitude'] = $request->input('latitude');
            // $input['longitude'] = $request->input('longitude');

            // $date=DateTime::createFromFormat('d/m/Y', $request->dob);
            // $input['dob']=$date->format('Y-m-d');
            $input['password'] = Hash::make($request->input("password"));
            $input['ip_address'] = $request->ip();
            $input['status'] = '0';
            $input['active_token'] = $this->rand_string(20);
            $input['created_at'] = Carbon::now()->toDateTimeString();
            $input['login_type'] = '3';

            $user = UserMaster::create($input);

            $admin = UserMaster::where(['type_id' => '1'])->first();
            $model = new Notification;
            $model->notifier_id = $admin->id;
            $model->from_id = $user->id;
            $model->message = $user->name . " has registered.";
            $model->is_view = '0';
            $model->status = '1';
            $model->created_at = date("Y-m-d h:i:s");
            $model->save();

            $url = Route('active-account', ['id' => base64_encode($user->id), 'token' => $user->active_token]);
            $link = '<a href="' . $url . '">Click Here</a>';
            $email_setting = $this->get_email_data('user_registration', array('NAME' => $user->name, 'LINK' => $link));
            $email_data = [
                'to' => $user->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];

            $template = view('mail.layouts.template')->render();
            $content = view('mail.' . $email_data['template'], $email_data['data'])->render();
            $view = str_replace('[[email_message]]', $content, $template);
            $res['content'] = $view;

           // $this->composeEmail($res, $email_setting, $user);
            $this->sendActivationMail($user);
            $data['success'] = 'Success';
            $data['link'] = 'login';
            $data['message'] = 'A Verification Link has been sent on your registered email address.';
            return response()->json($data);
        }
    }

    private function sendActivationMail($user)
    {
        $url = Route('active-account', ['id' => base64_encode($user->id), 'token' => $user->active_token]);
        $link = '<a href="' . $url . '">Click Here</a>';
        $email_setting = $this->get_email_data('user_registration', array('NAME' => $user->name, 'LINK' => $link));
        $email_data = [
            'to' => $user->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMailBySwiftMailer($email_data);
    }

    public function get_active_account(Request $request, $id, $token)
    {
        if ($id == "" && $token == "") {
            return redirect()->route('login')->with('error', 'Oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = UserMaster::where('id', $id)->where('active_token', $token)->first();
        if (empty($model)) {
            return redirect()->route('login')->with('error', 'Requested url is no longer valid. Please try again.');
        } else {
            if ($request->has('nemail')) {
                $model->email = $request->input('nemail');
            }
            $model->email_verification = '1';
            $model->active_token = NULL;
            $model->status = '1';
            $model->user_verifications = '1';
            $msg = 'Your email verification done successfully.Please login to your accout.';
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->ip_address = $request->ip();
            $model->save();
            return redirect()->route('login')->with('success', $msg);
        }
    }

    public function forgot_password()
    {
        $data = [];
        return view('site.forgot_password', $data);
    }

    public function user_forgot_password(ForgotRequest $request)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['reset_password_token'] = $this->rand_string(20);
            $model = UserMaster::where('email', '=', $input['email'])->where('login_type', '3')->first();
            $model->update($input);
            $link = '<a href="' . Route('user-reset-password', ['id' => base64_encode($model->id), 'token' => $model->reset_password_token]) . '" style="text-decoration: none;">Click here</a>';
            $email_setting = $this->get_email_data('user_forgot_password', array('NAME' => $model->name, 'LINK' => $link));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'forgot_password',
                'data' => ['message' => $email_setting['body']]
            ];

            $template = view('mail.layouts.template')->render();
            $content = view('mail.' . $email_data['template'], $email_data['data'])->render();
            $view = str_replace('[[email_message]]', $content, $template);
            $res['content'] = $view;


           // $this->composeEmail($res, $email_data, $model);
            $this->SendMailBySwiftMailer($email_data);
            $data_msg['link'] = "login";
            $data_msg['message'] = "A Reset Password Link has been sent to your registered email address";
            return response()->json($data_msg);
        }
    }

    public function get_reset_password($id, $token)
    {
        $data = [];
        if ($id === "" && $token === "") {
            return redirect()->route('/')->with('error', 'Oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = UserMaster::where('id', $id)->where('reset_password_token', $token)->first();
        if (empty($model)) {
            return redirect()->route('/')->with('error', 'Oops! Something went wrong in this url.');
        } else {
            AuthSession::put('user_id', $id);
            AuthSession::put('forgot_token', $token);
            return redirect()->route('reset-password');
        }
    }

    public function reset_password()
    {
        $data = [];
        return view('site.reset_password', $data);
    }

    public function post_reset_password(ResetRequest $request)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['reset_password_token'] = NULL;
            $user_id = AuthSession::get('user_id');
            $model = UserMaster::findOrFail($user_id);
            $model->update($input);

            $admin = UserMaster::where(['type_id' => '1'])->first();
            $user_master = UserMaster::findOrFail($user_id);

            $notification = new Notification;
            $notification->notifier_id = $admin->id;
            $notification->from_id = $user_id;
            $notification->message = $user_master->name . " has reset password.";
            $notification->is_view = '0';
            $notification->status = '1';
            $notification->created_at = date("Y-m-d h:i:s");
            $notification->save();

            AuthSession::remove('user_id');
            AuthSession::remove('forgot_token');
            $data_msg['link'] = Route('/');
            $data_msg['message'] = "The Password has been changed successfully";
            return response()->json($data_msg);
        }
    }

    public function login()
    {
        $data = [];
        if (!Auth()->guard('frontend')->guest()) {
            return redirect()->route('feed');
        }
        return view('site.login', $data);
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'email'     =>  ['required', 'email', 'exists:user_master,email'],
            'password'  =>  ['required'],
        ]);
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->only('email');

            $model = UserMaster::where('email', '=', $input['email'])->where('login_type', '3')->first();
            if (!empty($model)) {
                // if ($model['email_verification'] == 1) {
                    if ($model['status'] == '1' && $model['user_verifications'] == '1') {
                        if (Hash::check($request->input('password'), $model->password)) {
                            if ($request->has('rememberMe') && !empty($request->input('rememberMe'))) {
                                $expire = time() + 172800;
                                setcookie('xtreme_user_email', $request->input('email'), $expire);
                                setcookie('xtreme_user_password', $request->input('password'), $expire);
                            } else {
                                $expire = time() - 172800;
                                setcookie('xtreme_user_email', '', $expire);
                                setcookie('xtreme_user_password', '', $expire);
                            }
                        } else {
                            $data_msg['message'] = "!! Invalid Password !! ";
                            return response()->json($data_msg, 422);
                        }
                    } else {
                        $data_msg['message'] = "!! You can't login  until Admin approves your account !!";
                        return response()->json($data_msg, 422);
                    }
                // } else {
                //     $data_msg['message'] = "!! Verify Email Before Login !!";
                //     return response()->json($data_msg, 422);
                // }

                Auth::guard('frontend')->login($model);
                $model->ip_address = $request->ip();
                $model->last_login = Carbon::now()->toDateTimeString();
                $model->save();

                if ($model['type_id'] == 2 || $model['type_id'] == 3 || $model['type_id'] == 4) {
                    $data_msg['link'] = Route('dashboard');
                    $data_msg['message'] = "You are successfully logged in.";
                    return response()->json($data_msg);
                }
            } else {
                $data_msg['message'] = "!! Invalid Email !!";
                return response()->json($data_msg, 422);
            }
        }
    }

    public function getStories()
    {
        $data = UserMaster::with('stories')->where(['user_master.type_id' => '2', 'status' => '1'])->orderBy('id', 'desc')->get();

        return response()->json($data);
    }

    public function logout(Request $request)
    {
        Auth::guard('frontend')->logout();
        $request->session()->invalidate();
        return redirect('/')->with('success', 'You are successfully logged out.');
    }

    //Start social login controller//
    public function redirectToProvider($driver)
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->stateless()->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }


    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->stateless()->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty($user->email)
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse($user)
    {
        $model = UserMaster::where('email', $user->email)->first();
        if (empty($model->type_id)) {
            return redirect()->intended('signup');
        } else {
            return redirect()->intended('/');
        }
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = UserMaster::where('email', $providerUser->getEmail())->first();

        // if user already found
        if ($user) {
            // update the avatar and provider that might have changed
            $user->update([
                'name' => $providerUser->getName(),
                'social_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            // create a new user
            $user = UserMaster::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'social_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                // user can use reset password to create a password
                'password' => ''
            ]);
        }

        $admin = UserMaster::where(['type_id' => '1'])->first();
        $user_master = UserMaster::where('email', $providerUser->getEmail())->first();
        $notification = new Notification;
        $notification->notifier_id = $admin->id;
        $notification->from_id = $user_master->id;
        $notification->message = $user_master->name . " has registered via Social Login";
        $notification->is_view = '0';
        $notification->status = '1';
        $notification->created_at = date("Y-m-d h:i:s");
        $notification->save();

        // login the user
        Auth::guard('frontend')->login($user);

        return $this->sendSuccessResponse($user);
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    public function review()
    {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $data['total_review'] = Review::where('client_id', $user_id)->where('status', '1')->avg('score');
        return view('user.review', $data);
    }

    public function lang_change($lang)
    {
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}

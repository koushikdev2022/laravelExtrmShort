<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Jobs\SendMailJob;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Country;
use Carbon\Carbon;
use App\Models\Multilingual;
use App\Models\Notification;
use App\Models\Email;
use App\Models\Language;
use App\Models\MessageConnection;
use App\Models\SaveJob;
use App\Models\Settings;
use App\Models\WalletLog;
use Illuminate\Support\Facades\Mail;
use App\Models\Skill;
use App\Models\Tool;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

trait HelperTrait
{
    public function storeSaveJob($data)
    {
        $checkSaveJob = SaveJob::where(['project_id' => $data['project_id'], 'user_id' => $data['user_id']])->first();
        if (!empty($checkSaveJob)) {
            if ($checkSaveJob->status === '1') {
                $checkSaveJob->update(['status' => '3']);
            } else {
                $checkSaveJob->update(['status' => '1']);
            }
        } else {
            SaveJob::create(['project_id' => $data['project_id'], 'user_id' => $data['user_id'], 'status' => '1']);
        }
    }

    public function hasSaveJob($data)
    {
        return SaveJob::where(['project_id' => $data['project_id'], 'user_id' => $data['user_id'], 'status' => '1'])->count();
    }

    public function SendMailBySwiftMailer($data)
    {
        $template = view('mail.layouts.template')->render();
        $content = view('mail.' . $data['template'], $data['data'])->render();
        $view = str_replace('[[email_message]]', $content, $template);
        $data['content'] = $view;
        dispatch(new SendMailJob($data));
    }

    public function composeEmail($data, $email_setting, $user)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->Port = 587; // TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isHTML(true); // Set email format to HTML

            $mail->Username = 'cheyang786@gmail.com'; // SMTP username
            $mail->Password = '1AnkitDeveloper@'; // SMTP password

            $mail->setFrom('cheyang786@gmail.com', 'Xtremelongshot'); //Your application NAME and EMAIL
            $mail->Subject = $email_setting['subject']; //Message subject
            $mail->MsgHTML($data['content'], 'text/html'); // Message body
            $mail->addAddress($user->email, $user->name); // Target email
            $mail->send();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function get_email_data($slug, $replacedata = array())
    {
        $email_data = Email::where(['slug' => $slug])->first();
        $email_msg = "";
        $email_array = array();
        $email_msg = $email_data->body;
        $subject = $email_data->subject;
        if (!empty($replacedata)) {
            foreach ($replacedata as $key => $value) {
                $email_msg = str_replace("{{" . $key . "}}", $value, $email_msg);
            }
        }
        return array('body' => $email_msg, 'subject' => $subject);
    }


    function fileUpload(Request $request, $fname, $directory)
    {
        if ($request->hasFile($fname) || is_object($fname)) {  //check the file present or not
            $image = is_object($fname) ? $fname : $request->file($fname); //get the file
            $name = $this->rand_string(30) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/frontend/story/' . $directory . '/'); //public path folder dir
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    function rand_string($digits)
    {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function rand_number($digits)
    {
        $alphanum = "123456789" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }


    function getActiveLanguages()
    {
        $langages = Multilingual::select(['id', 'lang', 'lang_code', 'currency_code', 'currency_symbol'])->where(['status' => '1'])->oldest('lang_code')->get();
        if (sizeof($langages) === 0) {
            Multilingual::create([
                'lang' => 'English',
                'lang_code' => 'en',
                'currency_code' => 'USD',
                'currency_symbol' => '$',
                'status' => '1',
            ]);
            $langages = $this->getActiveLanguages();
        }
        return $langages;
    }


    public static function lastNotificationID()
    {
        $model = Notification::select('id')->orderBy('id', 'desc')->first();
        if (!empty($model)) {
            return ($model->id + 1);
        }
        return 1;
    }

    public static function makeNotification($data)
    {
        Notification::create($data);
    }

    public static function makeAsINACTIVE($ids, $type = 0)
    {
        $models = Notification::whereIn('id', $ids)->get();
        if (sizeof($models) > 0) {
            foreach ($models as $model) {
                if ($type == 1) {
                    $model->update(['is_view' => '1', 'status' => '3']);
                } else {
                    $model->update(['is_view' => '1']);
                }
            }
        }
    }

    public function makeSocialConfig()
    {

        $provider = [
            'callback' => stripos(url('auth/callback'), 'https') == false && request()->getHost() != '127.0.0.1' ? str_replace('http', 'https', url('auth/callback')) : url('auth/callback'),
        ];
        $facebook = $this->getFacebookSetting();
        // $google = $this->getGoogleSetting();
        $linkedin = $this->getLinkedinSetting();
        // if ($google) {
        //     $provider['providers']['Google'] = $google;
        // }
        if ($facebook) {
            $provider['providers']['Facebook'] = $facebook;
        }
        if ($linkedin) {
            $provider['providers']['LinkedIn'] = $linkedin;
        }
        return $provider;
    }

    public function buildGoogleCaptchSetting()
    {
        ///////For Google Captcha
        $google_client_client = Settings::select('value')->where('slug', 'google_captcha_site_key')->first();
        $google_client_secret = Settings::select('value')->where('slug', 'google_captcha_secret_key')->first();
        $google_client_client_value = $google_client_client->value ?? NULL;
        $google_client_secret_value = $google_client_secret->value ?? NULL;
        if (!empty($google_client_client_value) && !empty($google_client_secret_value)) {
            $this->rewriteEnvValue('GOOGLE_RECAPTCHA_KEY', $google_client_client_value);
            $this->rewriteEnvValue('GOOGLE_RECAPTCHA_SECRET', $google_client_secret_value);
        }
    }



    private function getFacebookSetting()
    {
        ///////For Fb
        $fb_client = Settings::select('value')->where('slug', 'fb_client')->first();
        $fb_secret = Settings::select('value')->where('slug', 'fb_secret')->first();
        $fb_client_value = $fb_client->value ?? NULL;
        $fb_secret_value = $fb_secret->value ?? NULL;
        if (!empty($fb_client_value) && !empty($fb_secret_value)) {
            return [
                'enabled' => true,
                'keys' => [
                    'key' => $fb_client_value,
                    'secret' => $fb_secret_value,
                ],
            ];
        }
    }

    private function getLinkedinSetting()
    {
        ///////For Linkedin
        $link_client = Settings::select('value')->where('slug', 'linkedin_client')->first();
        $link_secret = Settings::select('value')->where('slug', 'linkedin_secret')->first();
        $link_client_value = $link_client->value ?? NULL;
        $link_secret_value = $link_secret->value ?? NULL;
        if (!empty($link_client_value) && !empty($link_secret_value)) {
            return [
                'enabled' => true,
                'keys' => [
                    'key' => $link_client_value,
                    'secret' => $link_secret_value,
                ],
            ];
        }
    }


    public function rewriteEnvValue($key, $value)
    {
        $envFile = app()->environmentFilePath();
        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($envFile, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($envFile)
        ));
    }



    public function number_format_short($n)
    {
        $n_format = $n;
        $suffix = '';
        if ($n > 0 && $n < 1000) {
            // 1 - 999
            $n_format = floor($n);
            $suffix = '';
        } else if ($n >= 1000 && $n < 1000000) {
            // 1k-999k
            $n_format = floor($n / 1000);
            $suffix = 'K+';
        } else if ($n >= 1000000 && $n < 1000000000) {
            // 1m-999m
            $n_format = floor($n / 1000000);
            $suffix = 'M+';
        } else if ($n >= 1000000000 && $n < 1000000000000) {
            // 1b-999b
            $n_format = floor($n / 1000000000);
            $suffix = 'B+';
        } else if ($n >= 1000000000000) {
            // 1t+
            $n_format = floor($n / 1000000000000);
            $suffix = 'T+';
        }

        return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
    }

    public function convertEncoding($string)
    {
        return mb_convert_encoding($string, 'HTML-ENTITIES', 'utf-8');
    }

    public function getProjectDurations()
    {
        return [
            '1' => __('helpertrait.More then 6 Months'),
            '2' => __('helpertrait.3-6 Months'),
            '3' => __('helpertrait.1-3 Months'),
            '4' => __('helpertrait.Less then 1 Month')
        ];
    }

    public function getSortType()
    {
        return [
            '1' => __('helpertrait.Newest First'),
            // '2' => __('helpertrait.Oldest First'),
            '3' => 'Highest Rated Clients',
        ];
    }
    public function getUserDocumentType()
    {
        return [
            '1' => __('helpertrait.PASSPORT'),
            '2' => __('helpertrait.NATIONAL_ID'),
            '3' => __('helpertrait.DRIVINING_CARD'),
            '4' => __('helpertrait.TAX_ID'),
            '5' => __('helpertrait.VOTAR_ID'),
            '6' => __('helpertrait.BUSINESS_REGISTRATION'),
            '7' => __('helpertrait.PERMISES_PHOTO'),
            '8' => __('helpertrait.INTERNET_SPEED'),
            '9' => __('helpertrait.CERTIFICATE'),
            '10' => __('helpertrait.BUSINESS_AUDIT'),
        ];
    }

    public function getAllMainCategories()
    {

        return Category::with('translation')->where(['status' => '1'])->whereNull('parent_id')->oldest()->get();
    }
    public function getAllSkills()
    {

        return Skill::with('translation')->where(['status' => '1'])->oldest()->get();
    }
    public function getAllTools($user_skills)
    {
        return Tool::whereIn('skill_id', $user_skills)->where(['status' => '1'])->oldest()->get();
    }

    public function getCategoryByParent($id)
    {
        return Skill::with('translation')->where(['category_id' => $id, 'status' => '1'])->oldest()->get();
    }

    public function getSkillBy($id)
    {
        return Category::with('translation')->where('status', '1')->whereIn('parent_id', $id)->orderBy('parent_id', 'DESC')->get();
    }

    public function getSkillName($id)
    {
        return Skill::with('translation')->where(['id' => $id, 'status' => '1'])->first();
    }
    public function getToolName($id)
    {
        return Tool::where(['id' => $id, 'status' => '1'])->first();
    }

    public function getAllLanguages()
    {
        return Language::oldest('name')->get();
    }
    public function getAllCountry()
    {

        return Country::oldest('country_name')->get();
    }
    public function checkAndMakeConnection($code, $current_user_id)
    {
        $code = base64_decode($code);
        $checkConnection = MessageConnection::where(['to_user_id' => $code, ['status', '<>', '3']])->count();

        if ($checkConnection === 0) :
            MessageConnection::create([
                'from_user_id' => $current_user_id,
                'to_user_id' => $code,
                'project_id' => '',
                'bid_code' => '',
                'message' => 'Hi',
                'status' => '1',
            ]);
        endif;
    }

    public function storeWalletTransaction($detail)
    {
        if (isset($detail['id'])) {
            WalletLog::find($detail['id'])->update($detail);
        } else {
            WalletLog::create($detail);
        }
    }
    public function getOutsourcingTypes()
    {
        return [
            '1' => 'Established Call Centre /<br>BPO Company',
            '2' => 'Virtual Call Centre /<br>BPO Company',
            '3' => 'Freelancer or <br>Team of Freelancers',
        ];
    }
    public function getAvailabilityTypes()
    {
        return [
            '1' => '10hrs/wk',
            '2' => '20hrs/wk',
            '3' => '30hrs/wk',
            '4' => '40hrs/wk',
        ];
    }
    public function getSectors()
    {
        return [
            '1' => 'Accommodation / Real Estate',
            '2' => 'Agriculture, Forestry and Fishing',
            '3' => 'Arts / Recreation',
            '4' => 'Construction',
            '5' => 'E-commerce / Retail',
            '6' => 'Education',
            '7' => 'Engineering',
            '8' => 'Financial Services',
            '9' => 'Food / Drink',
            '10' => 'Healthcare / Sports',
            '11' => 'Hospitality',
            '12' => 'Manufacturing',
            '13' => 'Legal',
            '14' => 'Telecommunications and IT',
            '15' => 'Transportation',
            '16' => 'Utilities / Energy',
            '17' => 'Travel',
            '18' => 'Other',
        ];
    }
    public function getBudgetTypes()
    {
        return [
            '1' => 'Pay Per Transfer',
            '2' => 'Pay Per Lead',
            '3' => 'Pay Per Sale',
            '4' => 'Pay Per Entry',
            '10' => 'Pay Per ',
            '5' => 'Fixed Hourly Rate',
            '6' => 'Fixed Weekly Rate',
            '7' => 'Fixed Fortnight Rate',
            '8' => 'Fixed Monthly Rate',
            '9' => 'Fixed Budget for Project',
        ];
    }
    public function getBudgetTypesUnits()
    {
        return [
            '1' => 'Transfer',
            '2' => 'Lead',
            '3' => 'Sale',
            '4' => 'Entry',
            '5' => 'Hour',
            '6' => 'Week',
            '7' => 'Fortnight',
            '8' => 'Month',
            '9' => '',
        ];
    }

    public function getPayoutPeriods()
    {
        return [
            'weekly' => 'Weekly',
            'fortnight' => 'Fortnight',
            'monthly' => 'Monthly',
            'On Target Amount' => 'On Target Amount',
        ];
    }
    public function getApplicablePaymentMethods()
    {
        return [
            'hourly' => 'Fixed Hourly Rate',
            'weekly' => 'Fixed Weekly Rate',
            'fortnight' => 'Fixed Fortnight Rate',
            'monthly' => 'Fixed Monthly Rate',
            'budget' => 'Fixed Budget Rate',
        ];
    }
}

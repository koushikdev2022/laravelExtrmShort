<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Auth};
use App\Models\UserMaster;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => 'required|email|exists:user_master,email',
            'password' => 'required|max:50'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $model = UserMaster::where('email', '=', $this->email)->where('login_type', '3')->where("status", "<>", "3")->first();

            if (!empty($model)) {
                if ($model['status'] == '0')
                    $validator->errors()->add('password', "Your account is not activated. Please verify your email first.");
                else if ($model['status'] == '2')
                    $validator->errors()->add('password', "Your account is suspended. Please contact to admin.");
                else if ($model['status'] == '4')
                    $validator->errors()->add('password', "Your account is temporary Deleted. Please contact to admin.");
                else {
                    if (Hash::check($this->password, $model->password)) {
                    } else
                        $validator->errors()->add('password', "Incorrect Password.");
                }
            } else
                $validator->errors()->add('password', "User not found. Please sign up to login.");
        });
    }
}

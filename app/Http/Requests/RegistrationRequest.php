<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserMaster;

class RegistrationRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'password' => 'required|max:50',
            'confirm_password' => 'required|max:50|same:password',
            'check_policy' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $model = UserMaster::where('email', '=', $this->email)->where('login_type', '3')->where('status', '<>', '3')->first();
            if (!empty($model)) {

                $validator->errors()->add('email', "This email address is already in use.");
            }
            // if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $this->password))
            // {
            //     $validator->errors()->add('password', "Passwords must be min 6 characters and include an upper case, lower case and number");
            // }
        });
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name as field is required.',
            'password.required' => 'The Password as field is required.',
            'check_policy.required' => 'Check Policy as field is required.',
            'confirm_password.same' => 'The confirm password and password must match.',
            'email.required' => 'The email address field is required.',
        ];
    }
}

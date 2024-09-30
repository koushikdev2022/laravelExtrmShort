<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use App\Models\UserMaster;

class ResetRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $user_id = Session::get('user_id');
            $forgot_token = Session::get('forgot_token');
            $model = UserMaster::where([['id', '=', $user_id], ['reset_password_token', '=', $forgot_token]])->first();
            if (empty($model))
            {
                $validator->errors()->add('retype_password', 'User Not Found.');
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
        'retype_password.same' => 'The retype password and password must match.',
    ];
    }

}

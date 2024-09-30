<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserMaster;

class ForgotRequest extends FormRequest {

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
            'email' => 'required|email',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $model = UserMaster::where('type_id', '<>', '1')->where('login_type','3')->where('email', '=', $this->email)->where('status', '<', '2')->first();
            if (empty($model))
                $validator->errors()->add('email', 'No account with that email address exists in our system.');
        });
    }

}

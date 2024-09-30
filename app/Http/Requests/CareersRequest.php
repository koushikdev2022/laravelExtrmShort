<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|email|max:255',
            // 'subject' => 'required|min:10',
            'phone_no' => 'required',
            'category_id' => 'required',
            'message' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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

        $rules = [
            'receiver_id' => 'required|numeric',
        ];
        if ($this->upload_file_names) {
            $rules['upload_file_names'] = 'required';
        } else {
            $rules['message'] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        parent::messages();
        return [
            'upload_file_names.*.required' => 'Please upload a file',
            'file_names.*.max' => 'Uploaded image may not be greater than 15MB'
        ];
    }
}
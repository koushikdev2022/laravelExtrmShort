<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUploadPhotoRequest extends FormRequest
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
            'filedata' => 'required|max:25600',
        ];
    }

    public function messages()
    {
        parent::messages();
        return [
            // 'filedata.mimes' => 'The upload file must be an image (doc,docx,pdf,txt)',
            'filedata.max' => 'The upload file size not be greater then 25MB.',
        ];
    }
}
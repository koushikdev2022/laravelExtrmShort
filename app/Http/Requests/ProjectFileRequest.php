<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectFileRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'file' => 'required|max:30720',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $file = $this->file;
            $mime = $file->getMimeType();
            $split_mime = explode('/', $mime);
            $split_mime[0] = $split_mime[0] ?? '';
            $allowed_arr = ['video', 'image'];
            if (!in_array($split_mime[0], $allowed_arr)) {
                $validator->errors()->add('file', 'This file type ' . $split_mime[0] . ' not allowed.Only allowed type are ' . implode(',', $allowed_arr));
            }
        });
    }

}

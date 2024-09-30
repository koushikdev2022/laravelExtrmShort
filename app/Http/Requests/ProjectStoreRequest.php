<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectStoreRequest extends FormRequest {

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
            'title' => 'required',
            'description' => 'required',
            // 'availability' => 'required',
            'begin_date' => 'required',
            'begin_time' => 'nullable',
            // 'categories' => 'required',
            // 'sub_categories' => 'required',
            'start_address' => 'nullable',
            'phone' => 'required',
            'budget' => 'required',
            'final_address.*' => 'nullable',
            // 'services' => 'required',
            // 'ck_comp_point' => 'required',
            'ck_estimate' => 'nullable',
            // 'ck_notify' => 'required',
            // 'ck_visibility' => 'required'
        ];

    }
    public function messages()
    {
        return [
            'ck_comp_point.required' => 'Return to the first point',
            'ck_estimate.required' => 'The check estimate check box is required',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            // $user_id = Auth()->guard('frontend')->user()->id;
            // $total_active_bundle_sql = Bundle::where(['user_id' => $user_id, 'status' => '1']);
            // if (!empty($this->bid)) {
            //     $total_active_bundle_sql->where('id', '<>', $this->bid);
            // }
            // $total_active_bundle = $total_active_bundle_sql->count();

            // if ($total_active_bundle >= 4 && $this->status == '1') {
            //     $validator->errors()->add('status', 'You are maxed out! You can only feature 4 bundles at a time. Delete/Inactive an old bundle to add a new one.');
            // }
            // if (empty($this->bid) && empty($this->cover_image)) {
            //     $validator->errors()->add('cover_image', 'The cover image is required.');
            // }
//            if ($this->new_price < $this->old_price) {
//                $validator->errors()->add('new_price', 'The new price can not be less then old price.');
//            }
            // if (!isset($this->AllImages['image'])) {
            //     $validator->errors()->add('AllImages', 'The Project files field is required.');
            // }
        });
    }

}

<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\HelperTrait;
use App\Models\TestimonialTranslation;

class CreateTestimonialRequest extends FormRequest
{
    use HelperTrait;
    public $language_codes;
    public function __construct()
    {
        $this->language_codes = $this->getActiveLanguages();
    }
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
        $rules = [];

        $rules['name'] = 'required|max:100';
        $rules['location'] = 'required';
        $rules['subtitle'] = 'required';
        $rules['description'] = 'nullable|max:1500';
        $rules['over_all_rating'] = 'required';
        $rules['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:10240';
        $rules['status'] = 'required';
        return $rules;
    }

}

<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TranslationCategory;
use App\Traits\HelperTrait;

class UpdateCategoryRequest extends FormRequest
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

        $rules = [
            'status' => 'required'
        ];

        foreach ($this->language_codes as $language_code) {
            $rules[$language_code->lang_code . '.category_name'] = 'required|max:100';
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($this->language_codes as $language_code) {
                $checkCategoryName = TranslationCategory::where('category_name', $this->{$language_code->lang_code}['category_name'])->where('category_id', '<>', $this->id)->where('status', '1')->count();
                if ($checkCategoryName !== 0) {
                    $validator->errors()->add($language_code->lang_code . '.category_name', 'Category name already exists.');
                }
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model {

    protected $fillable = ['name', 'email', 'phone_no','category_id', 'message', 'status', 'created_at', 'updated_at'];
    protected $table = 'careers';

    public function translation_cat()
    {
        if (session()->has('locale')) {
            $lang = session()->get('locale');
            return $this->belongsTo(TranslationCategory::class, 'id', 'category_id')->where('lang_code', '=', $lang);
        }else{
            return $this->belongsTo(TranslationCategory::class, 'id', 'category_id')->where('lang_code', '=', 'en');
        }
    }

}

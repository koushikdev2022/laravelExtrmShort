<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{

    protected $fillable = ['parent_id', 'image', 'category_type', 'status'];


    public function translation_cat()
    {
        if (session()->has('locale')) {
            $lang = session()->get('locale');
            return $this->belongsTo(TranslationCategory::class, 'id', 'category_id')->where('lang_code', '=', $lang);
        }else{
            return $this->belongsTo(TranslationCategory::class, 'id', 'category_id')->where('lang_code', '=', 'en');
        } 
    }

    public function eventTrans()
    {
        return $this->hasMany(TranslationCategory::class, 'category_id');
    }

    // public function getImageAttribute($value)
    // {
    //     $file_path = public_path('public/uploads/frontend/category/' . $value);
    //     if (is_file($file_path)) {
    //         return asset('public/uploads/frontend/category/' . $value);
    //     }
    //     return asset('public/uploads/frontend/category/3d-architecture.png');
    // }


    public function translation($language = null)
    {
        if ($language == null) {
            $language = app()->getLocale();
        }
        return $this->hasOne(TranslationCategory::class, 'category_id')->where('lang_code', '=', $language);
    }

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            if (Cache::has('design.categories')) {
                Cache::forget('design.categories');
            }
        });
        static::created(function () {
            if (Cache::has('design.categories')) {
                Cache::forget('design.categories');
            }
        });
        static::updated(function () {
            if (Cache::has('design.categories')) {
                Cache::forget('design.categories');
            }
        });
    }
}

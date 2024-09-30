<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Cms extends Model {

    public $timestamps = false;
    protected $table = 'cms';

    public static function boot() {
        parent::boot();
        static::saved(function($instance) {

            if (Cache::has('home_page_cms_pages') && $instance->slug === 'home_page') {
                Cache::forget('home_page_cms_pages');
            }
            if (Cache::has('static_page_cms_pages') && $instance->slug === 'static_page_banner') {
                Cache::forget('static_page_cms_pages');
            }
            if (Cache::has('course_info_page_cms_pages') && $instance->slug === 'course_information') {
                Cache::forget('course_info_page_cms_pages');
            }
        });
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Multilingual extends Model {

    protected $fillable = ['lang', 'lang_code', 'status', 'currency_code', 'currency_symbol'];

    public static function boot() {
        parent::boot();
        static::saved(function() {
            if (Cache::has('languages')) {
                Cache::forget('languages');
            }
        });
        static::created(function() {
            if (Cache::has('languages')) {
                Cache::forget('languages');
            }
        });
        static::updated(function() {
            if (Cache::has('languages')) {
                Cache::forget('languages');
            }
        });
    }

}

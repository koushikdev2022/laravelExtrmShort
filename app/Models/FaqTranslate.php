<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTranslate extends Model {

    public $timestamps = false;
    protected $table = 'faq_translation';
    
    protected $fillable = ['faq_id','language_code','question','answer','status','created_at','updated_at'];
}

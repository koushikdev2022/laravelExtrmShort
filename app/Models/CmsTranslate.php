<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsTranslate extends Model {

    public $timestamps = false;
    protected $table = 'cms_translation';

    protected $fillable = ['name','cms_id','language_code','type','slug','page_name','content_name','content_body','status','created_at','updated_at'];
}

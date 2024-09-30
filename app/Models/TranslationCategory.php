<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslationCategory extends Model
{
    use HasFactory;

    protected $fillable=['category_id','lang_code','category_name','status'];

}
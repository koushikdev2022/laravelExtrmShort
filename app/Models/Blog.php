<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = ['title','slug','category','image','description','status','post_date','created_at','updated_at','created_by','written_by'];

    public function categoryFun()
    {
        return $this->belongsTo('App\Models\BlogCategory', 'category', 'id');
    }

    public function blogcategory()
    {
        return $this->hasMany(TranslationCategory::class, 'category_id');
    }
}

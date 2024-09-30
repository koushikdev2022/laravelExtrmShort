<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'testimonials';
    protected $fillable = ['name','subtitle','over_all_rating','location','image','description','status','created_at','updated_at','lang_code'];
}

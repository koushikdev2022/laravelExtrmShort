<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProducingWithUs extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'producing_with_us';
    protected $fillable = ['image','status','created_at','updated_at'];
}

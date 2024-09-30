<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";
    protected $fillable = ['user_id', 'client_id', 'score', 'message', 'status','created_at','updated_at'];
    
    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'client_id');
    }
}
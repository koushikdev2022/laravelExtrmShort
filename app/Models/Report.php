<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "reports";
    protected $fillable = ['user_id','author_id', 'project_id', 'message', 'status','created_at','updated_at'];
    
    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'user_id');
    }
}
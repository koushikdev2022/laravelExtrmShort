<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProject extends Model
{
    use HasFactory;

    protected $table = "report_project";
    
    protected $fillable = ['user_id','project_id', 'description', 'created_at','updated_at'];
    
    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'user_id');
    }

}

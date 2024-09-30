<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInfo extends Model
{
    use HasFactory;

    protected $table = 'project_info';

    protected $fillable = ['quality', 'quality_amount','licence_for','licence_amount','status','total','project_id','user_id','created_at', 'updated_at'];
}

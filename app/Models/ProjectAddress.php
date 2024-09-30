<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAddress extends Model
{
    use HasFactory;

    protected $table = "project_address";
    
    protected $fillable = ['final_address','final_longitude','final_latitude','address_line2','project_id','status'];

    public function project_address()
    {
        return $this->belongsTo(Project::class, 'id', 'project_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;

    protected $table = "project_files";

    protected $fillable = ['image', 'project_id','type','status','created_at','updated_at'];

    public function projects()
    {
        return $this->belongsTo(Project::class, 'id', 'project_id');
    }
}

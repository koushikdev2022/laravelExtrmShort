<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookmarkProject extends Model
{
    use HasFactory;

    protected $table = 'bookmark_project';

    protected $fillable = ['user_id','like_status','project_id'];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}

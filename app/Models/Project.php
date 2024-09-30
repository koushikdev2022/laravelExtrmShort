<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';

    protected $fillable = ['title', 'description', 'user_id', 'status', 'level', 'step', 'created_at', 'updated_at', 'category', 'location', 'keywords', 'playlist_id', 'video', 'video_extension', 'image', 'video_name', 'footage_code', 'orientation', 'duration', 'is_exclusive', 'exclusive_amount', 'watermark_video','event_id'];

    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }

    public function info()
    {
        return $this->hasMany(ProjectInfo::class, 'project_id', 'id');
    }

    public function likes()
    {
        return $this->hasOne(UserLikes::class, 'project_id', 'id');
    }

    public function bookmark()
    {
        return $this->hasOne(BookmarkProject::class, 'project_id', 'id');
    }
}

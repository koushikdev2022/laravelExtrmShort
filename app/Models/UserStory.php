<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStory extends Model
{
    use HasFactory;

    protected $table = 'user_stories';

    protected $fillable = ['image', 'status', 'created_at', 'updated_at', 'user_id', 'video', 'video_extension'];

    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }
}

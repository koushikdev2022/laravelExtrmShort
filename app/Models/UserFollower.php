<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{
    use HasFactory;

    protected $table = 'user_follow_list';

    protected $fillable = ['user_id', 'following_user_id', 'status' ];

    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }
}

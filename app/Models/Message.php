<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $fillable = ['connection_id', 'from_user_id', 'to_user_id', 'message_type', 'message', 'file_name', 'is_read'];

    public function from() {
        return $this->belongsTo(UserMaster::class, 'from_user_id', 'id');
    }

    public function to() {
        return $this->belongsTo(UserMaster::class, 'to_user_id', 'id');
    }

}

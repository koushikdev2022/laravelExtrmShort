<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageConnection extends Model
{

    protected $fillable = ['from_user_id', 'to_user_id', 'project_id', 'bid_code', 'message', 'status', 'updated_by'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = "support";
    protected $fillable = ['category', 'ticket_id', 'subject', 'description', 'user_id', 'liveagent_status', 'liveagent_reponse','order_id','order_status','agent_id','status','type'];

    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'user_id');
    }
}

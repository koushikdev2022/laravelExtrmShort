<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtendExpireDate extends Model {

    protected $table = "extend_expire_date";
    protected $fillable = ['user_id','subscription_id','amount','start_date','end_date','status'];

    public function subscription() {
        return $this->belongsTo('App\Models\SubscriptionPlan', 'subscription_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'user_id');
    }

}

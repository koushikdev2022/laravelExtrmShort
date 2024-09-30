<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model {

    protected $table = 'subscription_plans';
    protected $fillable = ['name','plan_id','amount','currency','duration','interval_day','status','plan_text'];
}
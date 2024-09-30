<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model {

    protected $table = "user_subscription";
    protected $fillable = ['user_id','verified_by_admin','reference_id','plan_id','subscription_id','amount','start_date','end_date','status'];

    public function plan() {
        return $this->belongsTo('App\Models\SubscriptionPlan', 'plan_id');
    }

    public function subscription() {
        return $this->belongsTo('App\Models\SubscriptionPlan', 'subscription_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'user_id');
    }

    public function get_subs($user){
        $check = $this->where('user_id',$user)->where('status','1')->where('end_date','>=', date('Y-m-d'))->first();
        if (empty($check)) {
            return 'Free';
        }else{
            return $check->plan->name;
        }
    }

    public function check_admin_verify($user){
        $check = $this->where('user_id',$user)->where(['status'=>'1', 'verified_by_admin'=>'1'])->where('end_date','>=', date('Y-m-d'))->first();
        if (empty($check)) {
            return false;
        }else{
            return true;
        }
    }

    public function check_plan_bought($user, $plan){
        $check = $this->where('user_id',$user)->where(['status'=>'1', 'plan_id'=>$plan])->first();
        if (empty($check)) {
            return false;
        }else{
            return true;
        }
    }

    public function expiry(){
        return $this->hasMany(ExtendExpireDate::class, 'subscription_id','id');
    }

}

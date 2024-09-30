<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Bid extends Model
{

    protected $fillable = ['project_id', 'author_id', 'user_id', 'offer', 'proposal', 'deadline', 'code','check_category','check_price','file','agreement','milestones','describe_recent_project','project_link','describe_qa','new_category_id','talent_status','milestones_update_user_id','withdrow_status', 'status', 'is_hour','is_read_contract_award'];
    
    protected $casts = [
        'milestones' => Json::class,
    ];


    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsTo(UserMaster::class, 'author_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function budget_details()
    {
        return $this->belongsTo(BidBudget::class, 'id','bid_id');
    }

    public function payment_milestones()
    {
        return $this->belongsTo(PaymentMilestones::class, 'id','bid_id');
    }

    public function budgets()
    {
        return $this->hasMany(BidBudget::class, 'bid_id');
    }

    public function bid_milestones()
    {
        return $this->hasMany(BidMilestone::class, 'bid_id');
    }

    public function milestones_report()
    {
        return $this->hasMany(SubmitMilestone::class, 'bid_id');
    }

    public function submit_milestone()
    {
        return $this->hasOne(SubmitMilestone::class, 'bid_id');
    }
}
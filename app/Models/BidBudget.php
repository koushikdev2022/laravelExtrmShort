<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidBudget extends Model
{
    use HasFactory;

    protected $fillable = ['bid_id', 'budget_type', 'budget_amount', 'is_open_for_any_bid', 'billable_target'];
}
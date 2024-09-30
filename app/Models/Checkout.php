<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkout';

    protected $fillable = ['order_id', 'project_id', 'user_id', 'amount', 'total', 'status', 'project_info_id'];

    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}

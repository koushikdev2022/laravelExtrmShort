<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscrowWallet extends Model
{
    use HasFactory;

    protected $table = 'escrow_wallet';
    protected $fillable = ['user_id','project_id', 'total_amount','amount','payment_gateway','status','created_at','updated_at','release_date'];

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
}
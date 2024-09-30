<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'holder_name', 'bank_name', 'branch_name', 'account_number', 'status'];

    protected $dates = [
        'created_at', 'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }
}

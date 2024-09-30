<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = ['user_id', 'order_id', 'transaction_id', 'first_name','last_name','email','amount','currency','status','payment_gateway','created_at','updated_at','project_id','seller_id'];
}

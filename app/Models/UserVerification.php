<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'identity', 'payment_method', 'deposite_made', 'email_address', 'profile', 'phone_number',
        'business_registration', 'premises_photo', 'internet_speed', 'business_audit'
    ];
}
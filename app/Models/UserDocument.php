<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;

    const BUSINESS_REG = '6';
    const PREMISES_PHOTO = '7';
    const INTERNET_SPEED = '8';
    const CERTIFICATES = '9';
    const BUSINESS_AUDIT = '10';


    protected $fillable = [
        'user_id', 'document_type', 'which_document', 'file_name', 'comments', 'status', 'document_title', 'country', 'address', 'schedule_date', 'contact_name', 'contact_email', 'contact_phone'
    ];

    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }
    public function countryDetail()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }
}
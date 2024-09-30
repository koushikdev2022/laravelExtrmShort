<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxDetail extends Model
{
    use HasFactory;

    protected $table = 'tax_details';
    
    protected $fillable = ['user_id', 'country', 'state', 'address', 'zip', 'city','us_person','legal_payer_name','chk_tax_certification','federation_tax_classification','identification_type','identification_number'];

    protected $casts = [
        'created_at', 'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id');
    }
}

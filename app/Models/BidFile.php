<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidFile extends Model
{
    use HasFactory;
    protected $table = 'bid_files';
    protected $fillable = ['bid_id', 'file','status','created_at','updated_at'];
}
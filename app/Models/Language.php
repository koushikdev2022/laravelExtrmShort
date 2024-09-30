<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Language extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    protected $table = 'languages';
    protected $fillable = ['Language','Code','Flag','status'];
}
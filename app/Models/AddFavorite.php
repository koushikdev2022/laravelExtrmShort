<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class AddFavorite extends Model {

    protected $table = 'add_favorites';
    protected $fillable = ['form_id','to_id','project_id','status','created_at','update_at'];

    public function to(){
        return $this->belongsTo(UserMaster::class, 'to_id','id');
    }

    public function from(){
        return $this->belongsTo(UserMaster::class, 'form_id','id');
    }
}

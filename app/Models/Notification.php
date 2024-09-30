<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $table = "notifications";
    
    protected $fillable = ['notifier_id', 'from_id', 'message', 'url', 'is_view', 'status'];

    public function author() {
        return $this->belongsTo('App\Models\UserMaster', 'from_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'notifier_id', 'id');
    }

    public static function convert_count($number) {
        $ret = $number;
        $length = strlen($number);
        if ($length >= 6 && $length <= 7) {
            $ret = round($number / 100000, 2) . ' Lac(s)';
        } else if ($length >= 8 && $length <= 9) {
            $ret = round($number / 10000000, 2) . ' Cr.';
        } else if ($length >= 4 && $length <= 5) {
            $ret = round($number / 1000, 2) . ' K';
        }
        return $ret;
    }

}

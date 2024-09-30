<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class UserMaster extends Model implements Authenticatable
{

    use \Illuminate\Auth\Authenticatable;

    protected $table = 'user_master';
    protected $fillable = [
        'type_id', 'stripe_id', 'username', 'field_of_work', 'name', 'first_name', 'last_name', 'password', 'email', 'phone', 'other_number', 'about_me', 'bio', 'address_line1', 'address_line2', 'latitude', 'longitude', 'gender',
        'city', 'state', 'zip', 'dob', 'country', 'profile_picture', 'user_categories', 'user_skills', 'outsourcing_type', 'timezone', 'languages', 'resume', 'remark', 'active_token', 'balance', 'login_type', 'status', 'reset_password_token', 'is_plan_used', 'subscription_end', 'created_by', 'updated_by', 'last_login', 'last_online_at', 'avaliable', 'cover_image', 'user_verifications','topic'
    ];

    protected $appends = array('thumb', 'avatar');
    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatarAttribute()
    {
        $value = $this->profile_picture;
        $file_path = public_path('storage/uploads/frontend/profile_picture/original/' . $value);
        if (is_file($file_path)) {
            return asset('storage/uploads/frontend/profile_picture/original/' . $value);
        }
        return asset('storage/frontend/images/profile_user.png');
    }

    public function getThumbAttribute()
    {
        $value = $this->profile_picture;
        $file_path = public_path('storage/uploads/frontend/profile_picture/thumb/' . $value);
        if (is_file($file_path)) {
            return asset('storage/uploads/frontend/profile_picture/thumb/' . $value);
        }
        return asset('storage/frontend/images/profile_user.png');
    }


    public function details()
    {
        return $this->belongsTo(UserDetail::class, 'id', 'user_id');
    }

    public function stories()
    {
        return $this->hasMany(UserStory::class, 'user_id', 'id');
    }

    public function countryDetail()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }
    // public function skills()
    // {
    //     return $this->belongsToMany(Category::class, 'user_skills', 'user_id', 'skill_id')->withTimestamps();
    // }
    public function verification()
    {
        return $this->belongsTo(UserVerification::class, 'id', 'user_id');
    }

    public function subscription()
    {
        return $this->belongsTo(UserSubscription::class, 'id', 'user_id');
    }
}

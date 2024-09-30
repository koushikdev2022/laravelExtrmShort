<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'category_id','skill_id','availablity', 'headline', 'available_on_weekend', 'outsourcing_type', 'hours', 'about', 'languages', 'educations','edus', 'services', 'tools', 'portfolios'];
    protected $casts = [
        'educations' => Json::class,
        'edus' => Json::class,
        'portfolios' => Json::class,
        'services' => 'array',
        'tools' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id', 'id');
    }

    public function getLanguagesAttribute($value)
    {
        return !empty($value) ? explode(',', $value) : [];
    }
    public function setLanguagesAttribute($value)
    {
        $this->attributes['languages'] = is_array($value) ? implode(',', $value) : $value;
    }
}
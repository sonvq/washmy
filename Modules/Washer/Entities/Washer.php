<?php

namespace Modules\Washer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Media\Entities\File;
use Modules\Washrequest\Entities\Washrequest;
use Modules\Rating\Entities\Rating;

class Washer extends Model
{
    use MediaRelation;
    
    protected $table = 'washer__washers';
    
    const EMPLOYMENT_TYPE_EMPLOYED = 'employed';
    const EMPLOYMENT_TYPE_SELF_EMPLOYED = 'self_employed';
    const EMPLOYMENT_TYPE_STUDENT = 'student';
    const EMPLOYMENT_TYPE_HOMEMAKER = 'homemaker';    
    const ZONE_WASHER_AVATAR_IMAGE = 'WasherAvatarImage'; 
    
    const SUBSCRIPTION_STATUS_PAID = 'paid';
    const SUBSCRIPTION_STATUS_UNPAID = 'unpaid';
    
    protected $fillable = [
        'email',
        'full_name',
        'password',
        'phone_number',
        'employment_type',
        'facebook_id',
        'push_notification',
        'first_time_login',
        'type',
        'subscription_status',
        'subscription_start_date',
        'subscription_end_date'
    ];
        
    protected $hidden = ['password'];
        
    public function avatar_image() {
        return $this->belongsToMany(File::class, 'media__imageables', 'imageable_id', 'file_id')
            ->wherePivot('imageable_type', self::class)
            ->wherePivot('zone', self::ZONE_WASHER_AVATAR_IMAGE)
            ->withTimestamps();
    }
    
    public function rating() {
        return $this->hasMany(Rating::class, 'washer_id', 'id');
    }
    
    public function wash_request()
    {
        return $this->hasMany(Washrequest::class, 'washer_id', 'id');
    }
}

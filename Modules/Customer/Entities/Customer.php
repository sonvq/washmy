<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\CustomerCarDetail;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Media\Entities\File;

class Customer extends Model
{

    use MediaRelation;
    
    protected $table = 'customer__customers';
    protected $fillable = [
        'email',
        'full_name',
        'password',
        'phone_number',
        'facebook_id',
        'push_notification',
        'first_time_login',
        'type'
    ];
    
    const ZONE_CUSTOMER_AVATAR_IMAGE = 'CustomerAvatarImage';
    
    
    protected $hidden = ['password'];
    
    public function car_detail()
    {
        return $this->hasMany(CustomerCarDetail::class, 'customer_id', 'id');
    }
    
    public function avatar_image() {
        return $this->belongsToMany(File::class, 'media__imageables', 'imageable_id', 'file_id')
            ->wherePivot('imageable_type', self::class)
            ->wherePivot('zone', self::ZONE_CUSTOMER_AVATAR_IMAGE)
            ->withTimestamps();
    }
}

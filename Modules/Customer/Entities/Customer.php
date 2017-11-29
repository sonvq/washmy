<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\CustomerCarDetail;

class Customer extends Model
{

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
    
    protected $hidden = ['password'];
    
    public function car_detail()
    {
        return $this->hasMany(CustomerCarDetail::class, 'customer_id', 'id');
    }
}

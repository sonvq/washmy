<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerCarDetail extends Model
{

    protected $table = 'customer_car_detail';
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
}

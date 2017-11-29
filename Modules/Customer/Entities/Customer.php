<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;

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
}

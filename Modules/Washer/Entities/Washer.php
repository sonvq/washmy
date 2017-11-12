<?php

namespace Modules\Washer\Entities;

use Illuminate\Database\Eloquent\Model;

class Washer extends Model
{

    protected $table = 'washer__washers';
    public $translatedAttributes = [];
    
    const EMPLOYMENT_TYPE_EMPLOYED = 'employed';
    const EMPLOYMENT_TYPE_SELF_EMPLOYED = 'self_employed';
    const EMPLOYMENT_TYPE_STUDENT = 'student';
    const EMPLOYMENT_TYPE_HOMEMAKER = 'homemaker';    
    
    protected $fillable = [
        'email',
        'full_name',
        'password',
        'phone_number',
        'employment_type',
        'facebook_id',
        'push_notification',
        'first_time_login',
        'type'
    ];
        
}

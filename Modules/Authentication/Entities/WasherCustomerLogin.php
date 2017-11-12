<?php

namespace Modules\Authentication\Entities;

use Illuminate\Database\Eloquent\Model;

class WasherCustomerLogin extends Model
{

    const WASHER_TYPE = 'washer';
    const CUSTOMER_TYPE = 'customer';
    protected $table = 'washer_customer_login';
    public $translatedAttributes = [];
    protected $fillable = [
        'washer_id',
        'customer_id',
        'token',
        'type'
    ];
}

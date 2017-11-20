<?php

namespace Modules\Authentication\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;
use Modules\Washer\Entities\Washer;

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
    
    public function customer () {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    
    public function washer () {
        return $this->hasOne(Washer::class, 'id', 'washer_id');
    }
}

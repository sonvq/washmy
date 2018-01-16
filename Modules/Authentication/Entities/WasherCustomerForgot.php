<?php

namespace Modules\Authentication\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;
use Modules\Washer\Entities\Washer;

class WasherCustomerForgot extends Model
{

    protected $table = 'washer_customer_forgot';
    protected $fillable = [
        'washer_id',
        'customer_id',
        'token',
        'status',
        'completed_at'
    ];
    
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
   
    public function washer(){
        return $this->belongsTo(Washer::class, 'washer_id', 'id');
    }
    
}
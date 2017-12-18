<?php

namespace Modules\Washrequest\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;
use Modules\Washer\Entities\Washer;

class Washrequest extends Model
{

    protected $table = 'washrequest__washrequests';
    protected $fillable = [
        'type',
        'car_plate_no',
        'car_color',
        'street_name',
        'block_no',
        'level',
        'car_park_lot_no',
        'notes',
        'customer_id',
        'washer_id',
        'status'
    ];
    
    const USER_REQUESTING = 'user_requesting';
    const USER_DECLINED = 'user_declined';
    const USER_ACCEPT_PAY = 'user_accept_pay';
    const USER_PAYMENT_DONE = 'user_payment_done';
    const USER_CANCEL_REQUEST = 'user_cancel_request';
    const USER_CONFIRM_REQUEST = 'user_confirm_request';
    const WASHER_ACCEPTED = 'washer_accepted';
    const WASHER_WASHING = 'washer_washing';
    const WASHER_DONE = 'washer_done';
    
            
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    
    public function washer(){
        return $this->belongsTo(Washer::class, 'washer_id', 'id');
    }
}

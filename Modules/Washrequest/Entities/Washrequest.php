<?php

namespace Modules\Washrequest\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;

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
        'customer_id'
    ];
    
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}

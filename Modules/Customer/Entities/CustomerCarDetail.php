<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerCarDetail extends Model
{

    protected $table = 'customer_car_detail';
    protected $fillable = [
        'customer_id',
        'car_plate_no',
        'car_color',        
    ];
}
<?php

namespace Modules\Rating\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;
use Modules\Washer\Entities\Washer;

class Rating extends Model
{

    protected $table = 'rating__ratings';
    protected $fillable = [
        'rate_number',
        'rate_comment',
        'washer_id',
        'customer_id'
    ];
    
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    
    public function washer(){
        return $this->belongsTo(Washer::class, 'washer_id', 'id');
    }
}

<?php

namespace Modules\Reporting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;
use Modules\Washer\Entities\Washer;
use Modules\Washrequest\Entities\Washrequest;

class Reporting extends Model
{

    protected $table = 'reporting__reportings';
    protected $fillable = [
        'customer_id',
        'washer_id',
        'report_type',
        'report_content',
        'washrequest_id'
    ];
    
    const CUSTOMER_MAKE_REPORT = 'customer_make_report';
    const WASHER_MAKE_REPORT = 'washer_make_report';
    
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    
    public function washer(){
        return $this->belongsTo(Washer::class, 'washer_id', 'id');
    }
    
    public function washrequest(){
        return $this->belongsTo(Washrequest::class, 'washrequest_id', 'id');
    }
}
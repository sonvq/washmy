<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $table = 'subscription__subscriptions';
    protected $fillable = [
        'washer_id',
        'subscription_start_date',
        'subscription_end_date',
        'ocbc_access_token'
    ];
}

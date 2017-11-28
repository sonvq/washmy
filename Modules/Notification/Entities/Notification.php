<?php

namespace Modules\Notification\Entities;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notification__notifications';
    protected $fillable = [
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'title',
        'message',
        'message_type',
        'is_new',
        'is_read'
    ];
    
    const NOTIFICATION_TYPE_CAR_WASH_REQUEST = 'CAR_WASH_REQUEST';
}

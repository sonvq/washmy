<?php

namespace Modules\Washer\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Washer\Entities\Washer;
use App\Common\Helper;

class WasherTransformer extends TransformerAbstract implements WasherTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(Washer $item) {
        $avatar = $item->avatar->first();
        
        $token = isset($item->token) ? $item->token : null;
        return [
            'id' => (int) $item->id,
            'email' => (string) $item->email,
            'full_name' => (string) $item->full_name,            
            'phone_number' => (string) $item->phone_number,
            'employment_type' => (string) $item->employment_type,
            'facebook_id' => (string) $item->facebook_id,
            'push_notification' => (int) $item->push_notification,
            'type' => (string) $item->type,
            'first_time_login' => (int) $item->first_time_login,            
            'token' => (string) $token,     
            'avatar' => (object) $avatar,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }

}                             
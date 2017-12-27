<?php

namespace Modules\Customer\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Customer\Entities\Customer;
use App\Common\Helper;
use Carbon\Carbon;

class CustomerTransformer extends TransformerAbstract implements CustomerTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(Customer $item) {
        
        $avatar = $item->avatar_image->first();        
        $washRequest = $item->wash_request;
        $countWashRequest = count($washRequest);
        $startCustomerDate = $item->created_at;
        $currentDate = Carbon::now();
        
        $month = $currentDate->diffInMonths($startCustomerDate);        
        
        $token = isset($item->token) ? $item->token : null;
        return [
            'id' => (int) $item->id,
            'email' => (string) $item->email,
            'full_name' => (string) $item->full_name,            
            'phone_number' => (string) $item->phone_number,
            'facebook_id' => (string) $item->facebook_id,
            'push_notification' => (int) $item->push_notification,
            'type' => (string) $item->type,
            'first_time_login' => (int) $item->first_time_login,            
            'token' => (string) $token,            
            'avatar' => (object) $avatar,
            'total_wash_request' => (int) $countWashRequest, 
            'customer_month_registered' => (int) $month,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }
}                             
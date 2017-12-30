<?php

namespace Modules\Washer\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Washer\Entities\Washer;
use App\Common\Helper;
use Modules\Washrequest\Entities\Washrequest;
use Carbon\Carbon;

class WasherTransformer extends TransformerAbstract implements WasherTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(Washer $item) {
        // Avatar
        $avatar = $item->avatar_image->first();
        
        // Count washrequest
        $washRequest = $item->wash_request->where('status', Washrequest::USER_CONFIRM_REQUEST);
        $countWashRequest = count($washRequest);
        
        // Cont average rating
        $ratings = $item->rating;
        $averageRating = 0;
        $totalRating = 0;
        if (count($ratings) > 0) {
            foreach ($ratings as $rating) {
                $totalRating = $totalRating + $rating->rate_number;
            }
            if ($totalRating > 0) {
                $averageRating = $totalRating / count($ratings);
            }
        }                
        
        // Count month from registered
        $startWasherDate = $item->created_at;
        $currentDate = Carbon::now();        
        $month = $currentDate->diffInMonths($startWasherDate);     
        
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
            'total_wash_request' => (int) $countWashRequest, 
            'average_rating' => number_format((float)$averageRating, 1, '.', ''),
            'washer_month_registered' => (int) $month,
            'token' => (string) $token,     
            'avatar' => (object) $avatar,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }

}                             
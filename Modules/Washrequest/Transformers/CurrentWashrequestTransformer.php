<?php

namespace Modules\Washrequest\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Washrequest\Entities\Washrequest;
use App\Common\Helper;
use Modules\Customer\Transformers\CustomerTransformer;
use Modules\Washer\Transformers\WasherTransformer;
use Modules\Rating\Transformers\RatingTransformer;
use Modules\Washrequest\Transformers\WashrequestTransformer;

class CurrentWashrequestTransformer extends TransformerAbstract implements CurrentWashrequestTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform($item) {
        $washRequestObject = new \stdClass();
        
        if ($item->id != null) {
            $washRequestTransformer = new WashrequestTransformer();
            $washRequestObject = $washRequestTransformer->transform($item);
        }
        
        $currentLoggedUser = Helper::getLoggedUser();
        $countCurrentRequest = 0;
        if ($currentLoggedUser) {
            $countCurrentRequest = Washrequest::where('customer_id', $currentLoggedUser->customer_id)
                ->whereIn('status', [
                    'user_requesting',
                    'washer_accepted',
                    'user_accept_pay',
                    'user_payment_done',
                    'washer_washing',
                    'washer_done'
                ])->count();
        }        
        
        return [
            'wash_request_object' => (object) $washRequestObject,
            'count_current_request' => (int) $countCurrentRequest,            
        ];
    }
}                             
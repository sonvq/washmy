<?php

namespace Modules\Rating\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Rating\Entities\Rating;
use App\Common\Helper;

class RatingTransformer extends TransformerAbstract implements RatingTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(Rating $item) {
        $customer = $item->customer;
        $washer = $item->washer;
        
        return [
            'id' => (int) $item->id,
            'customer_id' => (int) $item->customer_id,
            'customer' => (object) $customer,
                        
            'washer_id' => (int) $item->washer_id,
            'washer' => (object) $washer,
            
            'washrequest_id' => (int) $item->washrequest_id,
           
            'rate_number' => (int) $item->rate_number,
            'rate_comment' => (string) $item->rate_comment,
            
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }
}        

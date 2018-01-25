<?php

namespace Modules\Washrequest\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Washrequest\Entities\Washrequest;
use App\Common\Helper;
use Modules\Customer\Transformers\CustomerTransformer;
use Modules\Washer\Transformers\WasherTransformer;
use Modules\Rating\Transformers\RatingTransformer;

class WashrequestTransformer extends TransformerAbstract implements WashrequestTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(Washrequest $item) {
        
        $token = isset($item->token) ? $item->token : null;
        
        $customerObject = $item->customer;
        $customerTransformer = new CustomerTransformer();
        if ($customerObject) {
            $customerObject = $customerTransformer->transform($customerObject);
        }
        
        $washerObject = $item->washer;        
        $washerTransformer = new WasherTransformer();
        if ($washerObject) {
            $washerObject = $washerTransformer->transform($washerObject);
        }
        
        $ratingObject = $item->rating;
        $ratingTransformer = new RatingTransformer();
        if ($ratingObject) {
            $ratingObject = $ratingTransformer->transform($ratingObject);
        }
        
        return [
            'id' => (int) $item->id,
            'type' => (string) $item->type,
            'car_plate_no' => (string) $item->car_plate_no,
            'car_color' => (string) $item->car_color,
            'street_name' => (string) $item->street_name,
            'block_no' => (string) $item->block_no,
            'level' => (string) $item->level,
            'car_park_lot_no' => (string) $item->car_park_lot_no,
            'notes' => (string) $item->notes,
            'customer_id' => (int) $item->customer_id,
            'customer' => (object) $customerObject,
            'status' => (string) $item->status,
            'washer_id' => (int) $item->washer_id,
            'washer' => (object) $washerObject,
            'rating' => (object) $ratingObject,
            'payment_method' => (string) $item->payment_method,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }
}                             
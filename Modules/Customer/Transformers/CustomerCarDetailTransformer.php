<?php

namespace Modules\Customer\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Customer\Entities\CustomerCarDetail;
use App\Common\Helper;

class CustomerCarDetailTransformer extends TransformerAbstract implements CustomerCarDetailTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(CustomerCarDetail $item) {
        
        $token = isset($item->token) ? $item->token : null;
        return [
            'id' => (int) $item->id,
            'customer_id' => (int) $item->customer_id,
            'car_plate_no' => (string) $item->car_plate_no,
            'car_color' => (string) $item->car_color,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }
}                     

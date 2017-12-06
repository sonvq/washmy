<?php

namespace Modules\Washrequest\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Washrequest\Entities\Washrequest;
use App\Common\Helper;

class WashrequestTransformer extends TransformerAbstract implements WashrequestTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(Washrequest $item) {
        
        $token = isset($item->token) ? $item->token : null;
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
            'customer' => (object) $item->customer,
            'status' => (string) $item->status,
            'washer_id' => (int) $item->washer_id,
            'washer' => (object) $item->washer,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }
}                             
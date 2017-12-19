<?php

namespace Modules\Reporting\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Reporting\Entities\Reporting;
use App\Common\Helper;

class ReportingTransformer extends TransformerAbstract implements ReportingTransformerInterface {

    /**
     * Turn this item object into a generic array.
     *
     * @param $item
     * @return array
     */
    public function transform(Reporting $item) {
        $customer = $item->customer;
        $washer = $item->washer;
        $washrequest = $item->washrequest;
        
        return [
            'id' => (int) $item->id,
            'customer_id' => (int) $item->customer_id,
            'customer' => (object) $customer,
                        
            'washer_id' => (int) $item->washer_id,
            'washer' => (object) $washer,
            
            'washrequest_id' => (int) $item->washrequest_id,
            'washrequest' => (object) $washrequest,
            
            'report_type' => (string) $item->report_type,
            'report_content' => (string) $item->report_content,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
        ];
    }
}        

<?php

namespace Modules\Washrequest\Repositories\Eloquent;

use Modules\Washrequest\Repositories\WashrequestRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Washrequest\Entities\Washrequest;
use Carbon\Carbon;

class EloquentWashrequestRepository extends EloquentBaseRepository implements WashrequestRepository
{
    public function getWashRequestListCustomer($input, $perPage, $customerId) {
        $query = $this->model
                ->where('customer_id', $customerId)
                ->orderBy('created_at', 'desc');
        if (isset($input['date_from']) && !empty($input['date_from'])) {            
            $query = $query->where('created_at', '>=', $input['date_from'] . ' 00:00:00');
        }
        if (isset($input['date_to']) && !empty($input['date_to'])) {
            $query = $query->where('created_at', '<=', $input['date_to'] . ' 23:59:59');
        }
        return $query->paginate($perPage);
        
    }
    
    public function getWashRequestListWasher($input, $perPage, $washerId) {
        $query = $this->model
                ->where('washer_id', $washerId)
                ->orderBy('created_at', 'desc');
        if (isset($input['date_from']) && !empty($input['date_from'])) {            
            $query = $query->where('created_at', '>=', $input['date_from'] . ' 00:00:00');
        }
        if (isset($input['date_to']) && !empty($input['date_to'])) {
            $query = $query->where('created_at', '<=', $input['date_to'] . ' 23:59:59');
        }
        return $query->paginate($perPage);
        
    }
    
    public function updateExpiredRequest() {
        $currentTime = Carbon::now()->subMinute(2);
        $currentTimeString = $currentTime->toDateTimeString();
        $query = $this->model
                ->where('status', Washrequest::USER_REQUESTING)
                ->whereNull('washer_id')
                ->where('updated_at', '<', $currentTimeString)
                ->update(['status' => Washrequest::EXPIRED]);
    }
}

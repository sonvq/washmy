<?php

namespace Modules\Washrequest\Repositories\Eloquent;

use Modules\Washrequest\Repositories\WashrequestRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentWashrequestRepository extends EloquentBaseRepository implements WashrequestRepository
{
    public function getWashRequestListCustomer($perPage, $customerId) {
        $query = $this->model
                ->where('customer_id', $customerId)
                ->orderBy('created_at', 'desc');
        return $query->paginate($perPage);
        
    }
    
    public function getWashRequestListWasher($perPage, $washerId) {
        $query = $this->model
                ->where('washer_id', $washerId)
                ->orderBy('created_at', 'desc');
        return $query->paginate($perPage);
        
    }
}

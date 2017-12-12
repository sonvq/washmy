<?php

namespace Modules\Customer\Repositories\Eloquent;

use Modules\Customer\Repositories\CustomerRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Customer\Entities\Customer;

class EloquentCustomerRepository extends EloquentBaseRepository implements CustomerRepository
{
    protected $editableTextField = [
        'email', 
        'full_name',
        'phone_number'
    ];
            
    protected $editableImageField = [
        [
            'key' => 'avatar',
            'zone' => Customer::ZONE_CUSTOMER_AVATAR_IMAGE
        ]
    ];
    
    public function updateCustomerProfile($fileService, $fileRepository, $object, $input) {
        if (count($this->editableTextField) > 0) {
            foreach($this->editableTextField as $singleField) {
                if (isset($input[$singleField])) {
                    $object->$singleField = $input[$singleField];
                }
            }
        }

        // Handle file upload 
        if (count($this->editableImageField) > 0) {
            foreach($this->editableImageField as $singleArrayField) {
                if (isset($input[$singleArrayField['key']]) && !empty($input[$singleArrayField['key']])) {                
                    try {
                        Helper::uploadMediaFile($fileService, 
                                $fileRepository, 
                                $input[$singleArrayField['key']], 
                                $singleArrayField['zone'], $object, Customer::class);
                    } catch (\Exception $e) {
                        \Log::error($input[$singleArrayField['key']] . ' - updateCustomerProfile - EloquentCustomerRepository: ' . $e->getMessage());
                    }
                }
            }
        }
        return $object->save();
    }
}

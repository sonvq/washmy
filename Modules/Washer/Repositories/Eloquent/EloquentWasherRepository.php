<?php

namespace Modules\Washer\Repositories\Eloquent;

use Modules\Washer\Repositories\WasherRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use App\Common\Helper;
use Modules\Washer\Entities\Washer;

class EloquentWasherRepository extends EloquentBaseRepository implements WasherRepository
{
    protected $editableTextField = [
        'email', 
        'full_name',
        'phone_number',
        'employment_type'
    ];
     
    protected $editableImageField = [
        [
            'key' => 'avatar',
            'zone' => Washer::ZONE_WASHER_AVATAR_IMAGE
        ]
    ];
    
    public function updateWasherProfile($fileService, $fileRepository, $object, $input) {
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
                                $singleArrayField['zone'], $object, Washer::class);
                    } catch (\Exception $e) {
                        \Log::error($input[$singleArrayField['key']] . ' - updateWasherProfile - EloquentWasherRepository: ' . $e->getMessage());
                    }
                }
            }
        }
        return $object->save();
    }
}

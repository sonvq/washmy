<?php

namespace Modules\Base\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Modules\User\Entities\Sentinel\User;
use Dingo\Api\Routing\Helpers;
use Validator;
use App\Common\Helper;

class BaseController extends Controller
{
    use Helpers;
    
    protected $module_name;
    
    protected $validation_rules = [];
    
    protected function validateRequest($rulesName, $input) {
        $rules = config("asgard.$this->module_name.validations.$rulesName.rules", []);
        $messages = config("asgard.$this->module_name.validations.$rulesName.messages", []); 
        
        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return Helper::validationErrorResponse($validator);
        }  
        return true;
    }
    
    public function storeUserDeviceInfo($clientDeviceToken, $clientOS, $object) {
        if (!empty($clientDeviceToken) && !empty($clientOS)) {
            $arraySupportedDevicePush = config('onesignal.supported_devices');
            
            /*
             * Create new player id in one signal
             */
            try {
                $parametersPlayer = [
                    'device_type' => $arraySupportedDevicePush[$clientOS],
                    'identifier' => $clientDeviceToken
                ];
                
                $playerResponse = OneSignalExtra::createPlayer($parametersPlayer);

                $playerResponseObject = Helper::getReadableResponseFromGuzzle($playerResponse);
                
                if (isset($playerResponseObject->success) && $playerResponseObject->success == true) {
                    // Successfully create new player
                    $playerId = $playerResponseObject->id;
                    
                    $customerDeviceEloquent = new EloquentCustomerDeviceRepository();
                    $existingCustomerDevice = $customerDeviceEloquent->findOneByAttribute(array('strPlayerID' => $playerId));
                    if (!$existingCustomerDevice) {
                        $customerDevice = [
                            'strPlayerID' => $playerId,
                            'strDeviceToken' => $clientDeviceToken,
                            'strDeviceType' => $clientOS
                        ];

                        $savedDevice = $customerDeviceEloquent->create($customerDevice);
                    } else {
                        // Update the existing one with the logged in user id
                        $existingCustomerDevice->strUserID = $user->email;
                        $existingCustomerDevice->save();
                    }    
                }
            } catch (\Exception $e) {
                \Log::error('Store user device token error: ' . $e->getMessage());
                // echo $e->getMessage();
            }            
        }
    }
}

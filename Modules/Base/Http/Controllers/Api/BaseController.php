<?php

namespace Modules\Base\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Modules\User\Entities\Sentinel\User;
use Dingo\Api\Routing\Helpers;
use Validator;
use App\Common\Helper;
use OneSignal;
use Modules\Authentication\Repositories\Eloquent\EloquentWasherCustomerDeviceRepository;
use Modules\Authentication\Entities\WasherCustomerDevice;

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

            if (in_array($clientOS, array_keys($arraySupportedDevicePush))) {
                /*
                 * Create new player id in one signal
                 */
                try {
                    $parametersPlayer = [
                        'device_type' => $arraySupportedDevicePush[$clientOS],
                        'identifier' => $clientDeviceToken
                    ];

                    $playerResponse = OneSignal::createPlayer($parametersPlayer);

                    $playerResponseObject = Helper::getReadableResponseFromGuzzle($playerResponse);

                    if (isset($playerResponseObject->success) && $playerResponseObject->success == true) {
                        // Successfully create new player
                        $playerId = $playerResponseObject->id;

                        $deviceEloquent = new EloquentWasherCustomerDeviceRepository(new WasherCustomerDevice());
                        $existingDevice = $deviceEloquent->findByAttributes(array('player_id' => $playerId));
                        if (!$existingDevice) {
                            $customerDevice = [
                                'player_id' => $playerId,
                                'device_token' => $clientDeviceToken,
                                'device_type' => $clientOS
                            ];
                            if (!empty($object)) {
                                $key = $object->type . '_id';
                                $customerDevice[$key] = $object->id;
                                $customerDevice['type'] = $object->type;
                            }

                            $savedDevice = $deviceEloquent->create($customerDevice);
                        } else {
                            if (!empty($object)) {
                                $key = $object->type . '_id';
                                // Update the existing one with the logged in user id
                                $existingDevice->$key = $object->id;
                                $existingDevice->type = $object->type;
                                $existingDevice->save();
                            }
                        }    
                    }
                } catch (\Exception $e) {
                    \Log::error('BaseController - storeUserDeviceInfo - Store user device token error: ' . $e->getMessage());
                    // echo $e->getMessage();
                }       
            }
        }
    }
    
    protected function removeUserDeviceInfo($clientDeviceToken, $clientOS, $currentLoggedUser) {
        
        if (!empty($clientDeviceToken) && !empty($clientOS)) {
            $deviceEloquent = new EloquentWasherCustomerDeviceRepository(new WasherCustomerDevice());
        
            $key = $currentLoggedUser->type . '_id';
            $existingDevice = $deviceEloquent->findByAttributes(array(
                'device_token' => $clientDeviceToken, 
                'device_type' => $clientOS,
                $key => $currentLoggedUser->$key,
                'type' => $currentLoggedUser->type));
            
            if ($existingDevice) {
                $existingDevice->delete();
            }
        }
    }
}

<?php

namespace Modules\Washrequest\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Modules\User\Entities\Sentinel\User;
use Dingo\Api\Routing\Helpers;
use Modules\Base\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\Washer\Repositories\WasherRepository;
use Modules\Washer\Transformers\WasherTransformerInterface;
use Modules\Customer\Transformers\CustomerTransformerInterface;
use Hash;
use Modules\Authentication\Entities\WasherCustomerLogin;
use Illuminate\Support\Facades\Password;
use Modules\Authentication\Repositories\WasherCustomerLoginRepository;
use Modules\Customer\Repositories\CustomerRepository;
use App\Common\Helper;
use Modules\Washrequest\Repositories\WashrequestRepository;
use Modules\Washrequest\Transformers\WashrequestTransformerInterface;
use Modules\Customer\Repositories\CustomerCarDetailRepository;
use Modules\Authentication\Repositories\WasherCustomerDeviceRepository;
use OneSignal;
use Modules\Notification\Repositories\NotificationRepository;
use Modules\Notification\Entities\Notification;

class WashrequestController extends BaseController
{
    protected $module_name = 'washrequest';
            
    public function __construct(Request $request,  
            WasherRepository $washerRepository,
            CustomerRepository $customerRepository,
            WasherCustomerLoginRepository $washerCustomerLoginRepository,
            WashrequestRepository $washrequestRepository,
            CustomerCarDetailRepository $customerCarDetailRepository,
            WasherCustomerDeviceRepository $deviceRepository,
            NotificationRepository $notificationRepository,
            
            WasherTransformerInterface $washerTransformerInterface,
            CustomerTransformerInterface $customerTransformerInterface,
            WashrequestTransformerInterface $washrequestTransformerInterface)
    {
        
        $this->request = $request;
        $this->washer_repository = $washerRepository; 
        $this->customer_repository = $customerRepository;        
        $this->wash_request_repository = $washrequestRepository;
        $this->washer_customer_login_repository = $washerCustomerLoginRepository;
        $this->customer_car_detail_repository = $customerCarDetailRepository;
        $this->device_repository = $deviceRepository;
        $this->notification_repository = $notificationRepository;
                
        $this->washer_transformer = $washerTransformerInterface;
        $this->customer_transformer = $customerTransformerInterface;
        $this->washrequest_transformer = $washrequestTransformerInterface;
    }
    
    public function detailWashRequest($id) {
        $washRequest = $this->wash_request_repository->find($id);
        if(!$washRequest) {
            return Helper::notFoundErrorResponse(Helper::WASH_REQUEST_NOT_FOUND,
                        Helper::WASH_REQUEST_NOT_FOUND_TITLE,
                        Helper::WASH_REQUEST_NOT_FOUND_MSG);
        }
        
        return $this->response->item($washRequest, $this->washrequest_transformer);  
    }
    
    public function createWashRequest()
    {
        $input =  $this->request->all();                
        
        // Validate type customer or washer
        $validate = $this->validateRequest('api-create-wash-request', $input);
        if ($validate !== true) {
            return $validate;
        }
        $currentLoggedUser = Helper::getLoggedUser();
        // Successfull validated data, start to create new washer
        $input['customer_id'] = $currentLoggedUser->customer_id;
        $createdWashRequest = $this->wash_request_repository->create($input);
        
        // If save_for_next_time = yes, save car detail for next time
        if (isset($input['save_for_next_time']) && ($input['save_for_next_time'] == 'yes')) {
            if(isset($input['car_plate_no']) && !empty($input['car_plate_no']) 
                    && isset($input['car_color']) && !empty($input['car_color'])) {
                
                // Find existing car_plate_no and car_color of this customer_id
                $existingCustomerCarDetail = $this->customer_car_detail_repository->findByAttributes([
                    'car_plate_no' => $input['car_plate_no'],
                    'car_color' => $input['car_color'],
                    'customer_id' => $currentLoggedUser->customer_id
                ]);
                
                if (!$existingCustomerCarDetail) {
                    $createdCustomerCarDetail = $this->customer_car_detail_repository->create([
                        'customer_id' => $currentLoggedUser->customer_id,
                        'car_plate_no' => $input['car_plate_no'],
                        'car_color' => $input['car_color']
                    ]);
                }
                
            }
        }
        
        // Send push notification for all washer
        try {
            $playerIdToSend = $this->device_repository->getByAttributes(['type' => 'washer'])
                    ->pluck('player_id')->toArray();
            
            $deviceObjectToSend = $this->device_repository->getByAttributes(['type' => 'washer']);
                                
            $heading = 'New Car Wash Request';
            $message = 'You have a new car wash request, please press accept to proceed';
            
            
            if (count($playerIdToSend) > 0) {                
                
                foreach ($deviceObjectToSend as $singleDevice) {
                    $createdNotificationMessage = $this->notification_repository->create([
                        'title' => $heading,
                        'message' => $message,
                        'sender_id' => $currentLoggedUser->customer_id,
                        'sender_type' => 'customer',
                        'receiver_id' => $singleDevice->washer_id,
                        'receiver_type' => 'washer',
                        'message_type' => Notification::NOTIFICATION_TYPE_CAR_WASH_REQUEST
                    ]);
                }                

                $createdWashRequest->customer;
                $extraArray['object'] = $createdWashRequest->toArray();
                $extraArray['message'] = $createdNotificationMessage->toArray();
                
                /*
                * Send Push notification to OneSignal
                */                
                OneSignal::sendNotificationToUser(
                    $message, 
                    $playerIdToSend, 
                    $heading, 
                    $extraArray
                );  
            }
        } catch (\Exception $e) {
            \Log::error('Push notification error: ' . $e->getMessage());
        }
       
        return $this->response->item($createdWashRequest, $this->washrequest_transformer);   
    }
    

}


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
use Modules\Washrequest\Transformers\CurrentWashrequestTransformerInterface;
use Modules\Customer\Repositories\CustomerCarDetailRepository;
use Modules\Authentication\Repositories\WasherCustomerDeviceRepository;
use OneSignal;
use Modules\Notify\Repositories\NotifyRepository;
use Modules\Notify\Entities\Notify;
use Modules\Washrequest\Entities\Washrequest;
use Carbon\Carbon;
use Modules\Authentication\Entities\WasherCustomerDevice;

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
            NotifyRepository $notifyRepository,
            
            WasherTransformerInterface $washerTransformerInterface,
            CustomerTransformerInterface $customerTransformerInterface,
            WashrequestTransformerInterface $washrequestTransformerInterface,
            CurrentWashrequestTransformerInterface $currentWashrequestTransformerInterface)
    {
        
        $this->request = $request;
        $this->washer_repository = $washerRepository; 
        $this->customer_repository = $customerRepository;        
        $this->wash_request_repository = $washrequestRepository;
        $this->washer_customer_login_repository = $washerCustomerLoginRepository;
        $this->customer_car_detail_repository = $customerCarDetailRepository;
        $this->device_repository = $deviceRepository;
        $this->notify_repository = $notifyRepository;
                
        $this->washer_transformer = $washerTransformerInterface;
        $this->customer_transformer = $customerTransformerInterface;
        $this->washrequest_transformer = $washrequestTransformerInterface;
        $this->current_washrequest_transformer = $currentWashrequestTransformerInterface;
        
    }
    
    public function washerAcceptRequest($id) {
        
        $washRequest = $this->wash_request_repository->find($id);
        if(!$washRequest) {
            return Helper::notFoundErrorResponse(Helper::WASH_REQUEST_NOT_FOUND,
                        Helper::WASH_REQUEST_NOT_FOUND_TITLE,
                        Helper::WASH_REQUEST_NOT_FOUND_MSG);
        }
        if (empty($washRequest->washer_id)) {
            if ($washRequest->status == Washrequest::USER_REQUESTING) {            
                $currentLoggedUser = Helper::getLoggedUser();
                $washRequest->washer_id = $currentLoggedUser->washer_id;
                $washRequest->status = Washrequest::WASHER_ACCEPTED;
                $washRequest->save();

                // Push notification to user
                try {
                    $playerIdToSend = $this->device_repository->getByAttributes(['customer_id' => $washRequest->customer_id, 'type' => 'customer'])
                            ->pluck('player_id')->toArray();

                    $deviceObjectToSend = $this->device_repository->findByAttributes(['customer_id' => $washRequest->customer_id, 'type' => 'customer']);

                    $heading = $currentLoggedUser->washer->full_name . ' accepted your wash request';
                    $message = 'Washer ' . $currentLoggedUser->washer->full_name . ' has accepted your wash request, please confirm and process payment to continue';

                    if (count($playerIdToSend) > 0) {                

                        if ($deviceObjectToSend) {
                            $createdNotifyMessage = $this->notify_repository->create([
                                'title' => $heading,
                                'message' => $message,
                                'sender_id' => $currentLoggedUser->washer_id,
                                'sender_type' => 'washer',
                                'receiver_id' => $deviceObjectToSend->customer_id,
                                'receiver_type' => 'customer',
                                'message_type' => Notify::NOTIFICATION_TYPE_CAR_WASH_REQUEST
                            ]);
                        }                

                        $extraArray['object'] = $washRequest->toArray();
                        $extraArray['message'] = $createdNotifyMessage->toArray();

                        /*
                        * Send Push notification to OneSignal
                        */                
                        OneSignal::sendNotificationToUser(
                            $message, 
                            $playerIdToSend, 
                            $heading, 
                            $extraArray
                        );  
                        \Log::info('WashrequestController - washerAcceptRequest - Push notification success to player id: ' . print_r($playerIdToSend, true));
                    }
                } catch (\Exception $e) {
                    \Log::error('WashrequestController - washerAcceptRequest - Push notification error: ' . $e->getMessage());
                }
                return $this->response->item($washRequest, $this->washrequest_transformer);  
            } else {
                return Helper::badRequestErrorResponse(Helper::WASH_REQUEST_ALREADY_CANCELED_OR_EXPIRED,
                        Helper::WASH_REQUEST_ALREADY_CANCELED_OR_EXPIRED_TITLE,
                        Helper::WASH_REQUEST_ALREADY_CANCELED_OR_EXPIRED_MSG);
            }
        } else {
            return Helper::badRequestErrorResponse(Helper::WASH_REQUEST_ALREADY_ACCEPTED,
                        Helper::WASH_REQUEST_ALREADY_ACCEPTED_TITLE,
                        Helper::WASH_REQUEST_ALREADY_ACCEPTED_MSG);
        }
    }
    
    public function washerChangeRequestStatus($id) {
        $input =  $this->request->all();
        $currentLoggedUser = Helper::getLoggedUser();
        $washRequest = $this->wash_request_repository->find($id);
        
        $validate = $this->validateRequest('api-washer-change-request-status', $input);
        if ($validate !== true) {
            return $validate;
        }
        
        if(!$washRequest) {
            return Helper::notFoundErrorResponse(Helper::WASH_REQUEST_NOT_FOUND,
                        Helper::WASH_REQUEST_NOT_FOUND_TITLE,
                        Helper::WASH_REQUEST_NOT_FOUND_MSG);
        }
        
        if ($currentLoggedUser->washer_id == $washRequest->washer_id) {
            if (isset($input['status']) && !empty($input['status'])) {
                $washRequest->status = $input['status'];
                $washRequest->save();
                
                // Push notification to user
                try {
                    $playerIdToSend = $this->device_repository->getByAttributes(['customer_id' => $washRequest->customer_id, 'type' => 'customer'])
                            ->pluck('player_id')->toArray();

                    $deviceObjectToSend = $this->device_repository->findByAttributes(['customer_id' => $washRequest->customer_id, 'type' => 'customer']);

                    
                    if ($input['status'] == 'washer_washing') {
                        $heading = 'Wash request processing';
                        $message = 'Washer ' . $currentLoggedUser->washer->full_name . ' are washing your car now';
                    } else if ($input['status'] == 'washer_done') {
                        $heading = 'Wash request completed';
                        $message = 'Washer ' . $currentLoggedUser->washer->full_name . ' has completed the request, please confirm';
                    }

                    if (count($playerIdToSend) > 0) {                

                        if ($deviceObjectToSend) {
                            $createdNotifyMessage = $this->notify_repository->create([
                                'title' => $heading,
                                'message' => $message,
                                'sender_id' => $currentLoggedUser->washer_id,
                                'sender_type' => 'washer',
                                'receiver_id' => $deviceObjectToSend->customer_id,
                                'receiver_type' => 'customer',
                                'message_type' => Notify::NOTIFICATION_TYPE_CAR_WASH_REQUEST
                            ]);
                        }                

                        $extraArray['object'] = $washRequest->toArray();
                        $extraArray['message'] = $createdNotifyMessage->toArray();

                        /*
                        * Send Push notification to OneSignal
                        */                
                        OneSignal::sendNotificationToUser(
                            $message, 
                            $playerIdToSend, 
                            $heading, 
                            $extraArray
                        );  
                        \Log::info('WashrequestController - washerChangeRequestStatus - Push notification success to player id: ' . print_r($playerIdToSend, true));
                    }
                } catch (\Exception $e) {
                    \Log::error('WashrequestController - washerChangeRequestStatus - Push notification error: ' . $e->getMessage());
                }
                
                return $this->response->item($washRequest, $this->washrequest_transformer);  
            }
        } else {
            return Helper::forbiddenErrorResponse(Helper::NOT_SELECTED_WASHER,
                        Helper::NOT_SELECTED_WASHER_TITLE,
                        Helper::NOT_SELECTED_WASHER_MSG);
        }
    }
    
    public function customerChangeRequestStatus($id) {
        $currentLoggedUser = Helper::getLoggedUser();
        $washRequest = $this->wash_request_repository->find($id);
        $input =  $this->request->all();
        
        $validate = $this->validateRequest('api-customer-change-request-status', $input);
        if ($validate !== true) {
            return $validate;
        }
        
        if(!$washRequest) {
            return Helper::notFoundErrorResponse(Helper::WASH_REQUEST_NOT_FOUND,
                        Helper::WASH_REQUEST_NOT_FOUND_TITLE,
                        Helper::WASH_REQUEST_NOT_FOUND_MSG);
        }
        
        if ($currentLoggedUser->customer_id == $washRequest->customer_id) {
            if (isset($input['status']) && !empty($input['status'])) {
                $washRequest->status = $input['status'];
                $washRequest->save();
                
                // Push notification to washer
                try {
                    if (!empty($washRequest->washer_id)) {
                        $playerIdToSend = $this->device_repository->getByAttributes(['washer_id' => $washRequest->washer_id, 'type' => 'washer'])
                                ->pluck('player_id')->toArray();
                        $deviceObjectToSend = $this->device_repository->findByAttributes(['washer_id' => $washRequest->washer_id, 'type' => 'washer']);
                    } else {
                        $playerIdToSend = $this->device_repository->getByAttributes(['type' => 'washer'])
                                ->pluck('player_id')->toArray();
                        $deviceObjectToSend = $this->device_repository->findByAttributes(['type' => 'washer']);
                    }

                    if ($input['status'] == 'user_declined') {
                        $heading = 'Wash request declined';
                        $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' declined your wash request';
                    } else if ($input['status'] == 'user_accept_pay') {
                        $heading = 'Wash request accepted and processing payment';
//                        $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' has accepted your submission and making payment';
                        $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' has accepted your submission, please start your washing work';
                    } else if ($input['status'] == 'user_payment_done') {
                        $heading = 'Wash request payment done';
//                        $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' has done the payment, please start your washing work';
                        $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' has accepted your submission, please start your washing work';
                    } else if ($input['status'] == 'user_cancel_request') {
                        $heading = 'Wash request cancelled';
                        $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' has cancelled the wash request';
                    } else if ($input['status'] == 'user_confirm_request') {
                        $heading = 'Wash request confirmed';
                        $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' has confirmed your washing as done, congratulation!!!';
                    }

                    if (count($playerIdToSend) > 0) {                

                        if ($deviceObjectToSend) {
                            $createdNotifyMessage = $this->notify_repository->create([
                                'title' => $heading,
                                'message' => $message,
                                'sender_id' => $currentLoggedUser->customer_id,
                                'sender_type' => 'customer',
                                'receiver_id' => $deviceObjectToSend->washer_id,
                                'receiver_type' => 'washer',
                                'message_type' => Notify::NOTIFICATION_TYPE_CAR_WASH_REQUEST
                            ]);
                        }

                        $extraArray['object'] = $washRequest->toArray();
                        $extraArray['message'] = $createdNotifyMessage->toArray();

                        /*
                        * Send Push notification to OneSignal
                        */                
                        OneSignal::sendNotificationToUser(
                            $message, 
                            $playerIdToSend, 
                            $heading, 
                            $extraArray
                        );  
                        \Log::info('WashrequestController - customerChangeRequestStatus - Push notification success to player id: ' . print_r($playerIdToSend, true));
                    }
                } catch (\Exception $e) {
                    \Log::error('WashrequestController - customerChangeRequestStatus - Push notification error: ' . $e->getMessage());
                }
                
                
                return $this->response->item($washRequest, $this->washrequest_transformer);  
            }
        } else {
            return Helper::forbiddenErrorResponse(Helper::NOT_SELECTED_CUSTOMER,
                        Helper::NOT_SELECTED_CUSTOMER_TITLE,
                        Helper::NOT_SELECTED_CUSTOMER_MSG);
        }
        
    }
    
    public function customerRequestAgain($id) {
        $currentLoggedUser = Helper::getLoggedUser();
        $washRequest = $this->wash_request_repository->find($id);
        $input =  $this->request->all();              
        
        if(!$washRequest) {
            return Helper::notFoundErrorResponse(Helper::WASH_REQUEST_NOT_FOUND,
                        Helper::WASH_REQUEST_NOT_FOUND_TITLE,
                        Helper::WASH_REQUEST_NOT_FOUND_MSG);
        }
        
        if ($currentLoggedUser->customer_id == $washRequest->customer_id) {
            if (!empty($washRequest->washer_id)) {
                return Helper::forbiddenErrorResponse(Helper::WASH_REQUEST_ACCEPTED_CAN_NOT_REQUEST_AGAIN,
                    Helper::WASH_REQUEST_ACCEPTED_CAN_NOT_REQUEST_AGAIN_TITLE,
                    Helper::WASH_REQUEST_ACCEPTED_CAN_NOT_REQUEST_AGAIN_MSG);
            }
            
            $washRequest->status = Washrequest::USER_REQUESTING;
            $washRequest->updated_at = Carbon::now();
            $washRequest->save();

            // Send push notification again
            // Send push notification for all washer
            try {
                $playerIdToSend = $this->device_repository->getByAttributes(['type' => 'washer'])
                        ->pluck('player_id')->toArray();

                $deviceObjectToSend = WasherCustomerDevice::groupBy('washer_id')->where('type', 'washer')->get();       

                $heading = 'New Car Wash Request from ' . $currentLoggedUser->customer->full_name;
                $message = 'You have a new car wash request from user ' . $currentLoggedUser->customer->full_name . ', please accept to proceed';

                if (count($playerIdToSend) > 0) {                

                    foreach ($deviceObjectToSend as $singleDevice) {
                        $createdNotifyMessage = $this->notify_repository->create([
                            'title' => $heading,
                            'message' => $message,
                            'sender_id' => $currentLoggedUser->customer_id,
                            'sender_type' => 'customer',
                            'receiver_id' => $singleDevice->washer_id,
                            'receiver_type' => 'washer',
                            'message_type' => Notify::NOTIFICATION_TYPE_CAR_WASH_REQUEST
                        ]);
                    }                

                    $extraArray['object'] = $washRequest->toArray();
                    $extraArray['message'] = $createdNotifyMessage->toArray();

                    /*
                    * Send Push notification to OneSignal
                    */                
                    OneSignal::sendNotificationToUser(
                        $message, 
                        $playerIdToSend, 
                        $heading, 
                        $extraArray
                    );  
                    \Log::info('WashrequestController - customerRequestAgain - Push notification success to player id: ' . print_r($playerIdToSend, true));
                }
            } catch (\Exception $e) {
                \Log::error('WashrequestController - customerRequestAgain - Push notification error: ' . $e->getMessage());
            }
            
            return $this->response->item($washRequest, $this->washrequest_transformer);  
        } else {
            return Helper::forbiddenErrorResponse(Helper::NOT_OWNER_OF_REQUEST,
                        Helper::NOT_OWNER_OF_REQUEST_TITLE,
                        Helper::NOT_OWNER_OF_REQUEST_MSG);
        }
    }
    
    public function detailWashRequest($id) {
        // Change all existing pending washrequest > 120 seconds to expired request
        $expiredWashRequest = $this->wash_request_repository->updateExpiredRequest();
        
        $washRequest = $this->wash_request_repository->find($id);
        if(!$washRequest) {
            return Helper::notFoundErrorResponse(Helper::WASH_REQUEST_NOT_FOUND,
                        Helper::WASH_REQUEST_NOT_FOUND_TITLE,
                        Helper::WASH_REQUEST_NOT_FOUND_MSG);
        }
        
        return $this->response->item($washRequest, $this->washrequest_transformer);  
    }
    
    public function customerCurrentRequestList() {
        // Change all existing pending washrequest > 120 seconds to expired request
        $expiredWashRequest = $this->wash_request_repository->updateExpiredRequest();
        
        $input = $this->request->all();
        $perPage = (isset($input['per_page']) && $input['per_page'] > 0) ? $input['per_page'] : 15;
        
        $currentLoggedUser = Helper::getLoggedUser();

        $washRequestList = $this->wash_request_repository
                ->getCustomerCurrentRequestList($input, $perPage, $currentLoggedUser->customer_id);

        return $this->response->paginator($washRequestList, $this->washrequest_transformer);
    }
    
    public function listWashRequest() {
        // Change all existing pending washrequest > 120 seconds to expired request
        $expiredWashRequest = $this->wash_request_repository->updateExpiredRequest();
        
        $input = $this->request->all();
        $perPage = (isset($input['per_page']) && $input['per_page'] > 0) ? $input['per_page'] : 15;
        $currentLoggedUser = Helper::getLoggedUser();
        
        if ($currentLoggedUser->type == 'customer') {
            $washRequestList = $this->wash_request_repository
                    ->getWashRequestListCustomer($input, $perPage, $currentLoggedUser->customer_id);

            return $this->response->paginator($washRequestList, $this->washrequest_transformer);
        } else if ($currentLoggedUser->type == 'washer') {
            $washRequestList = $this->wash_request_repository
                    ->getWashRequestListWasher($input, $perPage, $currentLoggedUser->washer_id);

            return $this->response->paginator($washRequestList, $this->washrequest_transformer);
        }
    }
    
    public function customerCheckCurrentWashRequest() {
        // Change all existing pending washrequest > 120 seconds to expired request
        $expiredWashRequest = $this->wash_request_repository->updateExpiredRequest();
        
        $input =  $this->request->all();                
        
        $currentLoggedUser = Helper::getLoggedUser();
                
        $currentWashRequest = $this->wash_request_repository->findCurrentRunningWashRequest($currentLoggedUser->customer_id);

        if ($currentWashRequest) {   
            return $this->response->item($currentWashRequest, $this->current_washrequest_transformer);   
        } else {
            return $this->response->item(new Washrequest(), $this->current_washrequest_transformer);   
        }
        
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
        
        $washRequestReturn = $this->wash_request_repository->find($createdWashRequest->id);
        
        // Send push notification for all washer
        try {
            $playerIdToSend = $this->device_repository->getByAttributes(['type' => 'washer'])
                    ->pluck('player_id')->toArray();
            
            $deviceObjectToSend = WasherCustomerDevice::groupBy('washer_id')->where('type', 'washer')->get();            
                                
            $heading = 'New Car Wash Request from ' . $currentLoggedUser->customer->full_name;
            $message = 'You have a new car wash request from user ' . $currentLoggedUser->customer->full_name . ', please accept to proceed';
            
            
            if (count($playerIdToSend) > 0) {                
                
                foreach ($deviceObjectToSend as $singleObject) {
                    $createdNotifyMessage = $this->notify_repository->create([
                        'title' => $heading,
                        'message' => $message,
                        'sender_id' => $currentLoggedUser->customer_id,
                        'sender_type' => 'customer',
                        'receiver_id' => $singleObject->washer_id,
                        'receiver_type' => 'washer',
                        'message_type' => Notify::NOTIFICATION_TYPE_CAR_WASH_REQUEST
                    ]);
                }                

                $extraArray['object'] = $washRequestReturn->toArray();
                $extraArray['message'] = $createdNotifyMessage->toArray();
                
                /*
                * Send Push notification to OneSignal
                */                
                OneSignal::sendNotificationToUser(
                    $message, 
                    $playerIdToSend, 
                    $heading, 
                    $extraArray
                );  
                \Log::info('WashrequestController - createWashRequest - Push notification success to player id: ' . print_r($playerIdToSend, true));
            }
        } catch (\Exception $e) {
            \Log::error('WashrequestController - createWashRequest - Push notification error: ' . $e->getMessage());
        }        
       
        return $this->response->item($washRequestReturn, $this->washrequest_transformer);   
    }
    

}


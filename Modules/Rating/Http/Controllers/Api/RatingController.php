<?php

namespace Modules\Rating\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Modules\User\Entities\Sentinel\User;
use Dingo\Api\Routing\Helpers;
use Modules\Base\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Password;
use App\Common\Helper;
use OneSignal;
use Modules\Rating\Repositories\RatingRepository;
use Modules\Rating\Entities\Rating;
use Modules\Rating\Transformers\RatingTransformerInterface;
use Modules\Notify\Entities\Notify;
use Modules\Authentication\Repositories\WasherCustomerDeviceRepository;
use Modules\Notify\Repositories\NotifyRepository;
use Modules\Washrequest\Entities\Washrequest;
use Modules\Washer\Entities\Washer;

class RatingController extends BaseController
{
    protected $module_name = 'rating';
            
    public function __construct(Request $request, 
            RatingRepository $ratingRepository,
            RatingTransformerInterface $ratingTransformer,
            WasherCustomerDeviceRepository $deviceRepository,
            NotifyRepository $notifyRepository)
    {
        
        $this->request = $request;
        $this->rating_repository = $ratingRepository;
        $this->rating_transformer = $ratingTransformer;
        $this->device_repository = $deviceRepository;
        $this->notify_repository = $notifyRepository;
    }
    
    public function create()
    {             
        
       $input =  $this->request->all();                
        
        // Validate type customer or washer
        $validate = $this->validateRequest('api-create-rating', $input);
        if ($validate !== true) {
            return $validate;
        }
        $currentLoggedUser = Helper::getLoggedUser();
        // Successfull validated data, start to create new reporting
        
        // Find existing rating, customer can only rate washer 1 time for 1 request        
        $ratingObject = Rating::where('customer_id', $currentLoggedUser->customer_id)
                ->where('washrequest_id', $input['washrequest_id'])
                ->where('washer_id', $input['washer_id'])
                ->first();
        
        if ($ratingObject) {
            return Helper::badRequestErrorResponse(Helper::RATING_EXISTED,
                    Helper::RATING_EXISTED_TITLE,
                    Helper::RATING_EXISTED_MSG);
        }
                
        $input['customer_id'] = $currentLoggedUser->customer_id;
        
        $createdRating = $this->rating_repository->create($input);
        
        if (isset($input['washer_id']) && !empty($input['washer_id'])) {
            $washerObject = Washer::where('id', $input['washer_id'])->first();
            if ($washerObject && ($washerObject->push_notification == 1)) {
                
                // Push notification to washer
                try {
                    $playerIdToSend = $this->device_repository->getByAttributes(['washer_id' => $input['washer_id'], 'type' => 'washer'])
                            ->pluck('player_id')->toArray();

                    $deviceObjectToSend = $this->device_repository->findByAttributes(['washer_id' => $input['washer_id'], 'type' => 'washer']);

                    $heading = 'You received a rating from a customer';
                    $message = 'Customer ' . $currentLoggedUser->customer->full_name . ' rate ' . $input['rate_number'] . ' star for your washing service';
                    $washRequestObject = Washrequest::where('id', $input['washrequest_id'])->first();

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
                        $washRequestObject->rating;

                        $extraArray['object'] = $washRequestObject->toArray();
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
                        \Log::info('RatingController - create - Push notification success to player id: ' . print_r($playerIdToSend, true));
                        
                    }
                } catch (\Exception $e) {
                    \Log::error('RatingController - create - Push notification error: ' . $e->getMessage());
                }
            }
        }
        
        return $this->response->item($createdRating, $this->rating_transformer);   
    }
    
}


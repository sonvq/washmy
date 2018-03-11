<?php

/**
 * 
 * @author 	
 */

namespace App\Common;

use App\Exceptions\CommonException;
use Illuminate\Support\Facades\Session;
use Modules\Agent\Repositories\Eloquent\EloquentAgentMemberLoginRepository;
use Modules\Agent\Entities\AgentMemberLogin;
use Modules\Core\Contracts\Setting;
use Modules\Media\Entities\Imageable;
use Modules\Media\Events\FileWasUploaded;
use Modules\Authentication\Entities\WasherCustomerLogin;

class Helper {
    
    const UNPROCESSABLE_ENTITY = 'UNPROCESSABLE_ENTITY';     
    const UNPROCESSABLE_ENTITY_MSG = 'The given data failed to pass validation';     
    
    const LOGIN_FAIL = 'LOGIN_FAIL';
    const LOGIN_FAIL_TITLE = 'Wrong credentials';
    const LOGIN_FAIL_MSG = 'Invalid email or password';
    
    const MISSING_TOKEN = 'MISSING_TOKEN';
    const MISSING_TOKEN_TITLE = 'Missing token';
    const MISSING_TOKEN_MSG = 'Token is not provided';
    
    const RATING_EXISTED = 'RATING_EXISTED';
    const RATING_EXISTED_TITLE = 'Error message';
    const RATING_EXISTED_MSG = 'You already rated this washer for this wash request';
            
    const INVALID_TOKEN = 'INVALID_TOKEN';  
    const INVALID_TOKEN_TITLE = 'Invalid token';     
    const INVALID_TOKEN_MSG = 'Your session has expired or you login another device, please login again';
    
    const CAR_DETAIL_NOT_FOUND = 'CAR_DETAIL_NOT_FOUND';  
    const CAR_DETAIL_NOT_FOUND_TITLE = 'Error message';     
    const CAR_DETAIL_NOT_FOUND_MSG = 'Car not found or has been deleted';

    const ONLY_CAR_OWNER_ALLOWED = 'ONLY_CAR_OWNER_ALLOWED';  
    const ONLY_CAR_OWNER_ALLOWED_TITLE = 'Error message';     
    const ONLY_CAR_OWNER_ALLOWED_MSG = 'Only car owner is allowed';
    

    const USER_NOT_FOUND = 'USER_NOT_FOUND';  
    const USER_NOT_FOUND_TITLE = 'User not found';     
    const USER_NOT_FOUND_MSG = 'User does not exist or has been deleted';
    
    const FACEBOOK_ERROR = 'FACEBOOK_ERROR';  
    const FACEBOOK_ERROR_TITLE = 'Error message';     
    
    
    const WRONG_NOW_PASSWORD = 'WRONG_NOW_PASSWORD';  
    const WRONG_NOW_PASSWORD_TITLE = 'Error message';     
    const WRONG_NOW_PASSWORD_MSG = 'Old password is not correct';
    
    const ONLY_CUSTOMER_ROLE_ALLOWED = 'ONLY_CUSTOMER_ROLE_ALLOWED';
    const ONLY_CUSTOMER_ROLE_ALLOWED_TITLE = 'Permission Denied';
    const ONLY_CUSTOMER_ROLE_ALLOWED_MSG = 'Only customer role allowed';
    
    const FAIL_TO_SEND_EMAIL = 'FAIL_TO_SEND_EMAIL';  
    const FAIL_TO_SEND_EMAIL_TITLE = 'Error message';     
    const FAIL_TO_SEND_EMAIL_MSG = 'Server can not send email, please check with administrator';
    
    const SUBSCRIPTION_REQUIRED = 'SUBSCRIPTION_REQUIRED';
    const SUBSCRIPTION_REQUIRED_TITLE = 'Error message';     
    const SUBSCRIPTION_REQUIRED_MSG = 'In order to receive car wash notifications, you are required to pay a monthly subscription of $10';
    
    const SUBSCRIPTION_ALREADY_PAID = 'SUBSCRIPTION_ALREADY_PAID';
    const SUBSCRIPTION_ALREADY_PAID_TITLE = 'Error message';     
    const SUBSCRIPTION_ALREADY_PAID_MSG = 'You are already paid for a monthly subscription of $10';
    
    const ONLY_WASHER_ROLE_ALLOWED = 'ONLY_WASHER_ROLE_ALLOWED';
    const ONLY_WASHER_ROLE_ALLOWED_TITLE = 'Permission Denied';
    const ONLY_WASHER_ROLE_ALLOWED_MSG = 'Only washer role allowed';
    
    const WASH_REQUEST_NOT_FOUND = 'WASH_REQUEST_NOT_FOUND';  
    const WASH_REQUEST_NOT_FOUND_TITLE = 'Wash request not found';     
    const WASH_REQUEST_NOT_FOUND_MSG = 'Wash request does not exist or has been deleted';
    
    const NOT_OWNER_OF_REQUEST = 'NOT_OWNER_OF_REQUEST';
    const NOT_OWNER_OF_REQUEST_TITLE = 'Error message';     
    const NOT_OWNER_OF_REQUEST_MSG = 'Only owner of this wash request allowed';
    
    const WASH_REQUEST_ACCEPTED_CAN_NOT_REQUEST_AGAIN = 'WASH_REQUEST_ACCEPTED_CAN_NOT_REQUEST_AGAIN';
    const WASH_REQUEST_ACCEPTED_CAN_NOT_REQUEST_AGAIN_TITLE = 'Error message';     
    const WASH_REQUEST_ACCEPTED_CAN_NOT_REQUEST_AGAIN_MSG = 'Wash request accepted by a washer, can not request again';
        
    
    const WASH_REQUEST_ALREADY_ACCEPTED = 'WASH_REQUEST_ALREADY_ACCEPTED';  
    const WASH_REQUEST_ALREADY_ACCEPTED_TITLE = 'Error message';     
    const WASH_REQUEST_ALREADY_ACCEPTED_MSG = 'This wash request already accepted by another washer';
    
    const WASH_REQUEST_ALREADY_CANCELED_OR_EXPIRED = 'WASH_REQUEST_ALREADY_CANCELED_OR_EXPIRED';  
    const WASH_REQUEST_ALREADY_CANCELED_OR_EXPIRED_TITLE = 'Error message';     
    const WASH_REQUEST_ALREADY_CANCELED_OR_EXPIRED_MSG = 'This wash request has been expired or canceled by customer';
    
    
    const NOT_SELECTED_WASHER = 'NOT_SELECTED_WASHER';  
    const NOT_SELECTED_WASHER_TITLE = 'Error message';     
    const NOT_SELECTED_WASHER_MSG = 'Only washer of this request can change the status';
    
    const NOT_SELECTED_CUSTOMER = 'NOT_SELECTED_CUSTOMER';  
    const NOT_SELECTED_CUSTOMER_TITLE = 'Error message';     
    const NOT_SELECTED_CUSTOMER_MSG = 'Only customer of this request can change the status';
    
    const IMAGE_ATTRIBUTES = [
        'id',
        'filename',
        'extension',
        'mimetype',
        'filesize',
        'folder_id',
        'path_string',
        'media_type',
        'created_at',
        'updated_at'
    ];
    
    public static function getLoggedUser($platform = null) {
        $persistence_code = request()->header('USER-TOKEN');

        if (!empty($persistence_code)) {
            $washerCustomerLoginObject = WasherCustomerLogin::where('token', $persistence_code)->first();
            if(!empty($washerCustomerLoginObject)) {
                $washerCustomerLoginObject->customer;
                $washerCustomerLoginObject->washer;
                return $washerCustomerLoginObject;
            }
        }
        return null;        
    }
    
    public static function uploadMediaFile($fileService, $fileRepository, $inputFile, $zone, $object, $entityClass, $gallerry = null) {
        $savedFile = $fileService->store($inputFile);
        if (!is_string($savedFile)) {
            if (!$gallerry){
                $oldMediaFile = $fileRepository->findFileByZoneForEntity($zone, $object);
                if (!empty($oldMediaFile)) {
                    \DB::table('media__imageables')->where(array('file_id' => $oldMediaFile->id, 'imageable_id' => $object->id, 'zone' => $zone))->delete();
                }
            }
            event(new FileWasUploaded($savedFile));
            $object->files()->attach($savedFile->id, ['imageable_type' => $entityClass, 'zone' => $zone]);
            
            return $savedFile;
        }           
        return false;
    }
    
    public static function imageTransformer($item, $relation) {
        $result = [];
       
        if ($item->$relation) {
            $arrayItem = $item->$relation->toArray();
            if (count($arrayItem) > 0) {
                $firstItem = $arrayItem[0];            
                $result = array_only($firstItem, self::IMAGE_ATTRIBUTES);    
            }            
        }
        return $result;
    }

    public static function galleryTransformer($item, $relation) {
        $result = [];

        if ($item->$relation) {
            $arrayItem = $item->$relation->toArray();
            if (count($arrayItem) > 0) {
                foreach ($arrayItem as $firstItem ){
                    $result[] = array_only($firstItem, self::IMAGE_ATTRIBUTES);
                }

            }
        }
        return array_values($result);
    }

    public static function getToken() {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < 51; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }    
    
    public static function generateRandomPassword() {
        $alphabe = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $number = '1234567890';
        $pass = array();
        $alphaLength = strlen($alphabe) - 1;
        $numberLength = strlen($number) - 1;
        for ($i = 0; $i < 5; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabe[$n];
        }
        for ($i = 0; $i < 3; $i++) {
            $n = rand(0, $numberLength);
            $pass[] = $number[$n];
        }
        shuffle($pass);
        return implode($pass); 
    }

    public static function convertLocalTimeToUTC($inputLocalTime) {
        date_default_timezone_set('UTC');
        $dateInLocal = new \DateTime($inputLocalTime, new \DateTimeZone(\Setting::get('core::default-timezone')));
        $dateInLocal->setTimezone(new \DateTimeZone('UTC'));
        $dateInUTC = $dateInLocal->format('Y-m-d H:i:s');
        return $dateInUTC;
    }
    
    public static function currentTimeBySettingConfig($format = 'Y-m-d H:i:s') {
        date_default_timezone_set('UTC');
        $currentDateUTC = new \DateTime(gmdate('Y-m-d H:i:s'), new \DateTimeZone('UTC'));
        $currentDateUTC->setTimezone(new \DateTimeZone(\Setting::get('core::default-timezone')));
        $dateReturn = $currentDateUTC->format($format);
        return $dateReturn;
    }
    
    public static function validationErrorResponse($validation) {

        $errorsMessage = $validation->errors();
        $messageArray = $validation->errors()->all();
        
        $validationArray = [];
        $validationArray['title'] = Helper::UNPROCESSABLE_ENTITY_MSG;
        $validationArray['first_error'] = $messageArray[0];
        $validationArray['details'] = $errorsMessage;        
        
        return Helper::responseFormat(Helper::UNPROCESSABLE_ENTITY, $validationArray, null, true, 422);
    }
    
    public static function unauthorizedErrorResponse ($key, $title, $message) {
        return Helper::commonErrorResponse($key, $title, $message, 401);
    }
    
    public static function notFoundErrorResponse ($key, $title, $message) {
        return Helper::commonErrorResponse($key, $title, $message, 404);
    }
    
    public static function badRequestErrorResponse ($key, $title, $message) {
        return Helper::commonErrorResponse($key, $title, $message, 400);
    }
    
    public static function forbiddenErrorResponse ($key, $title, $message) {
        return Helper::commonErrorResponse($key, $title, $message, 403);
    }

    public static function internalServerErrorResponse ($key, $title, $message) {
        return Helper::commonErrorResponse($key, $title, $message, 500);
    }

    public static function commonErrorResponse (
            $messageKey = null, 
            $messageTitle = null, 
            $messageContent = null,
            $statusCode = null) {
               
        $errorsMessage = [];
        $errorsMessage['title'] = $messageTitle;
        $errorsMessage['first_error'] = $messageContent;
        $errorsMessage['details'] = null;       
        
         return Helper::responseFormat($messageKey, $errorsMessage, null, true, $statusCode);         
    }


    public static function responseFormat($messageKey = null, 
            $errorsMessage = null, $data = null, $hasError = null, $statusCode = null) {
        
        $result = [
            'message_key' => $messageKey,
            'error_message' => $errorsMessage,
            'data' => $data,
            'has_error'=> $hasError,
            'status_code' => $statusCode,
            'server_time' => time(),
        ];
        
        return response()->json($result, $statusCode);
    }

    public static function getReadableResponseFromGuzzle($response) {
        return json_decode($response->getBody()->__toString());
    }


  
}

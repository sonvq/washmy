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
    
    const INVALID_TOKEN = 'INVALID_TOKEN';  
    const INVALID_TOKEN_TITLE = 'Invalid token';     
    const INVALID_TOKEN_MSG = 'The given token is invalid';

    const USER_NOT_FOUND = 'USER_NOT_FOUND';  
    const USER_NOT_FOUND_TITLE = 'User not found';     
    const USER_NOT_FOUND_MSG = 'User does not exist or has been deleted';
    
    const ONLY_CUSTOMER_ROLE_ALLOWED = 'ONLY_CUSTOMER_ROLE_ALLOWED';
    const ONLY_CUSTOMER_ROLE_ALLOWED_TITLE = 'Permission Denied';
    const ONLY_CUSTOMER_ROLE_ALLOWED_MSG = 'Only customer role allowed';
    
    const ONLY_WASHER_ROLE_ALLOWED = 'ONLY_WASHER_ROLE_ALLOWED';
    const ONLY_WASHER_ROLE_ALLOWED_TITLE = 'Permission Denied';
    const ONLY_WASHER_ROLE_ALLOWED_MSG = 'Only washer role allowed';
    
    const WASH_REQUEST_NOT_FOUND = 'WASH_REQUEST_NOT_FOUND';  
    const WASH_REQUEST_NOT_FOUND_TITLE = 'Wash request not found';     
    const WASH_REQUEST_NOT_FOUND_MSG = 'Wash request does not exist or has been deleted';
    

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

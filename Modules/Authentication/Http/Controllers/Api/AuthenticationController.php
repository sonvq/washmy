<?php

namespace Modules\Authentication\Http\Controllers\Api;

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
use Validator;
use Illuminate\Support\Facades\Mail;
use Modules\Media\Services\FileService;
use Modules\Media\Repositories\FileRepository;
use Modules\Customer\Entities\Customer;
use Modules\Washer\Entities\Washer;
use App\Common\FacebookWrapper;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Carbon\Carbon;
use Modules\Authentication\Repositories\WasherCustomerForgotRepository;
use Modules\Authentication\Entities\WasherCustomerForgot;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Repositories\SubscriptionRepository;

class AuthenticationController extends BaseController
{
    protected $module_name = 'authentication';
            
    public function __construct(Request $request,  
            WasherRepository $washerRepository,
            CustomerRepository $customerRepository,
            WasherCustomerLoginRepository $washerCustomerLoginRepository,
            WasherTransformerInterface $washerTransformerInterface,
            CustomerTransformerInterface $customerTransformerInterface,
            FileService $fileService,
            FileRepository $fileRepository,
            WasherCustomerForgotRepository $washerCustomerForgot,
            SubscriptionRepository $subscriptionRepository)
    {
        
        $this->request = $request;
        $this->washer_repository = $washerRepository; 
        $this->customer_repository = $customerRepository;
        $this->washer_transformer = $washerTransformerInterface;
        $this->washer_customer_login_repository = $washerCustomerLoginRepository;
        $this->customer_transformer = $customerTransformerInterface;
        $this->file_repository = $fileRepository;
        $this->file_service = $fileService;
        $this->washer_customer_forgot = $washerCustomerForgot;
        $this->subscription_repository = $subscriptionRepository;
    }
    
    public function forgotPassword() {
        $input = $this->request->all();
        
        // Validate login
        $validateType = $this->validateRequest('api-check-forgot-password', $input);
        if ($validateType !== true) {
            return $validateType;
        }                
                
        $token  = Password::getRepository()->createNewToken();
        
        $emailAddress = $input['email'];
        $washerObject = $this->washer_repository->findByAttributes(['email' => $emailAddress]);
        
        if ($washerObject) {
            Mail::send('authentication::frontend.mail.mail_forgot_password', ['type' => 'washer', 'user' => $washerObject, 'token' => $token], function ($m) use ($input) {
                $m->to($input['email'])->subject(trans('authentication::messages.forgot_email.email_title'));
            });
            if (Mail::failures()) {
                return Helper::internalServerErrorResponse(Helper::FAIL_TO_SEND_EMAIL,
                            Helper::FAIL_TO_SEND_EMAIL_TITLE,
                            Helper::FAIL_TO_SEND_EMAIL_MSG);
            } else {
                // Save the token for forgot password
                $this->washer_customer_forgot->create([
                    'token' => $token,
                    'washer_id' => $washerObject->id,
                    'status' => WasherCustomerForgot::STATUS_PENDING
                ]);
                        
                return $this->response->array(['data' => trans('authentication::messages.SUCCESSFUL_SEND_FORGOT_PASSWORD')]);
            }
        } else {
            $customerObject = $this->customer_repository->findByAttributes(['email' => $emailAddress]);
            if ($customerObject) {
                Mail::send('authentication::frontend.mail.mail_forgot_password', ['type' => 'customer', 'user' => $customerObject, 'token' => $token], function ($m) use ($input) {
                    $m->to($input['email'])->subject(trans('authentication::messages.forgot_email.email_title'));
                });
                if (Mail::failures()) {
                    return Helper::internalServerErrorResponse(Helper::FAIL_TO_SEND_EMAIL,
                                Helper::FAIL_TO_SEND_EMAIL_TITLE,
                                Helper::FAIL_TO_SEND_EMAIL_MSG);
                } else {
                    // Save the token for forgot password
                    $this->washer_customer_forgot->create([
                        'token' => $token,
                        'customer_id' => $customerObject->id,
                        'status' => WasherCustomerForgot::STATUS_PENDING
                    ]);

                    return $this->response->array(['data' => trans('authentication::messages.SUCCESSFUL_SEND_FORGOT_PASSWORD')]);
                }
            }else{
                return $this->response->array(['data' => trans('authentication::messages.SUCCESSFUL_SEND_FORGOT_PASSWORD')]);
            }
        }        
    }
    
    
    public function getProfileCustomer($id) {
        $currentLoggedUser = Helper::getLoggedUser();
        
        $customerObject = Customer::find($id);
        
        if (!$customerObject) {
            return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
        }
        
        return $this->response->item($customerObject, $this->customer_transformer);
    }
    
    public function getProfileWasher($id) {
        $currentLoggedUser = Helper::getLoggedUser();
        
        $washerObject = Washer::find($id);
        
        if (!$washerObject) {
            return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
        }
        
        return $this->response->item($washerObject, $this->washer_transformer);
    }
    
    public function updateProfile() {
        $input = $this->request->all();
        $currentLoggedUser = Helper::getLoggedUser();
        
        if ($currentLoggedUser->type == 'customer') {
            $customerObject = $currentLoggedUser->customer;
           
            $updateRules = [
                'avatar' => 'image|mimes:jpeg,bmp,png,gif|image_extension|max:10240',                
                'email' => 'email|max:255|unique:users,email|unique:washer__washers,email|unique:customer__customers,email,' . $customerObject->id,
                'full_name' => 'max:255',
                'phone_number' => 'max:255',
            ];
            $validator = Validator::make($input, $updateRules);

            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }       
                                    
            $this->customer_repository->updateCustomerProfile($this->file_service, $this->file_repository, $customerObject, $input);
                        
            $customerObject->token = $currentLoggedUser->token;
            return $this->response->item($customerObject, $this->customer_transformer);
        } else if ($currentLoggedUser->type == 'washer') {  
            $washerObject = $currentLoggedUser->washer;
            
            $updateRules = [
                'avatar' => 'image|mimes:jpeg,bmp,png,gif|image_extension|max:10240',
                'email' => 'email|max:255|unique:users,email|unique:customer__customers,email|unique:washer__washers,email,' . $washerObject->id,
                'full_name' => 'max:255',
                'phone_number' => 'max:255',
                'employment_type' => 'in:employed,self_employed,student,homemaker'
            ];
                    
            $validator = Validator::make($input, $updateRules);
                        
            if ($validator->fails()) {
                return Helper::validationErrorResponse($validator);
            }  
                        
            $this->washer_repository->updateWasherProfile($this->file_service, $this->file_repository, $washerObject, $input);
            
            $washerObject->token = $currentLoggedUser->token;
            return $this->response->item($washerObject, $this->washer_transformer);
        }        
    }
    
    public function saveSubscriptionWasher() {
        $input = $this->request->all();
        
        // Validate subscription washer
        $validateSubscriptionWasher = $this->validateRequest('api-check-subscription-washer', $input);
        if ($validateSubscriptionWasher !== true) {
            return $validateSubscriptionWasher;
        }    
        
        $currentLoggedUser = Helper::getLoggedUser();
        $washer = $currentLoggedUser->washer;
        if ($washer->subscription_status == Washer::SUBSCRIPTION_STATUS_UNPAID) {
            $washer->subscription_status = Washer::SUBSCRIPTION_STATUS_PAID;
            $today = Carbon::now();            
            $expired_date = $today->copy()->addDays(30);
            
            $washer->subscription_start_date = $today;
            $washer->subscription_end_date = $expired_date;
            $washer->push_notification = 1;
            $washer->ocbc_access_token = $input['access_token'];
            $washer->save();
            
            // Save Washer subscription history
            $accessToken = $input['access_token'];
            $subscription = $this->subscription_repository->create([
                'washer_id' => $washer->id,
                'subscription_start_date' => $today,
                'subscription_end_date' => $expired_date,
                'ocbc_access_token' => $accessToken
            ]);
            
            
            return $this->response->item($washer, $this->washer_transformer);
        } else {
            return Helper::forbiddenErrorResponse(Helper::SUBSCRIPTION_ALREADY_PAID,
                        Helper::SUBSCRIPTION_ALREADY_PAID_TITLE,
                        Helper::SUBSCRIPTION_ALREADY_PAID_MSG);
        }
            
    }
    
    public function togglePushNotification() {
        $input = $this->request->all();
        $currentLoggedUser = Helper::getLoggedUser();
        
        if ($currentLoggedUser->type == 'customer') {
            $customerObject = $currentLoggedUser->customer;
                           
            if ($customerObject->push_notification == 0) {
                $customerObject->push_notification = 1;
            } else {
                $customerObject->push_notification = 0;
            }
            
            $customerObject->save();            
                        
            $customerObject->token = $currentLoggedUser->token;
            return $this->response->item($customerObject, $this->customer_transformer);
        } else if ($currentLoggedUser->type == 'washer') {  
            $washerObject = $currentLoggedUser->washer;
            
            if ($washerObject->push_notification == 0) {
                // Check if washer already paid subscription or not
                if ($washerObject->subscription_status == Washer::SUBSCRIPTION_STATUS_UNPAID) {
                    return Helper::forbiddenErrorResponse(Helper::SUBSCRIPTION_REQUIRED,
                        Helper::SUBSCRIPTION_REQUIRED_TITLE,
                        Helper::SUBSCRIPTION_REQUIRED_MSG);
                }                
                $washerObject->push_notification = 1;    
            } else {
                $washerObject->push_notification = 0;
            }
            
            $washerObject->save();   
            
            $washerObject->token = $currentLoggedUser->token;
            return $this->response->item($washerObject, $this->washer_transformer);
        }     
    }
    
    public function register()
    {
        $input =  $this->request->all();        
        $clientDeviceToken = $this->request->header('DEVICE-TOKEN');
        $clientOS = $this->request->header('DEVICE-TYPE');
        \Log::info('register - AuthenticationController - $clientDeviceToken = ' . $clientDeviceToken);
        \Log::info('register - AuthenticationController - $clientOS = ' . $clientOS);
        
        // Validate type customer or washer
        $validateType = $this->validateRequest('api-check-type-register', $input);
        if ($validateType !== true) {
            return $validateType;
        }
        
        $type = $input['type'];
        if ($type == 'washer') {
            // Validate washer registration
            $validateWasher = $this->validateRequest('api-check-washer-register', $input);
            if ($validateWasher !== true) {
                return $validateWasher;
            }
            
            // Successfull validated data, start to create new washer
            $createdWasher = $this->washer_repository->create([
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'full_name' => $input['full_name'],
                'phone_number' => $input['phone_number'],
                'employment_type' => $input['employment_type'],            
                'type' => WasherCustomerLogin::WASHER_TYPE
            ]);
            
            $token = Password::getRepository()->createNewToken();
            $this->washer_customer_login_repository->saveTokenLogin($createdWasher, $token);
            
            $washerReturned = $this->washer_repository->find($createdWasher->id);
            
            if (!empty($clientDeviceToken) && !empty($clientOS)) {
                $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $washerReturned);
            }
            
            $logMessage = 'AuthenticationController - register - Washer register with email: ' . $input['email'] . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
            \Log::info($logMessage);
                    
            $washerReturned->token = $token;
            return $this->response->item($washerReturned, $this->washer_transformer);
        } else {
            // Validate customer registration
            $validateCustomer = $this->validateRequest('api-check-customer-register', $input);
            if ($validateCustomer !== true) {
                return $validateCustomer;
            }
            
            // Successfull validated data, start to create new washer
            $createdCustomer = $this->customer_repository->create([
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'full_name' => $input['full_name'],
                'phone_number' => $input['phone_number'],                      
                'type' => WasherCustomerLogin::CUSTOMER_TYPE
            ]);
            
            $token = Password::getRepository()->createNewToken();
            $this->washer_customer_login_repository->saveTokenLogin($createdCustomer, $token);
            
            $customerReturned = $this->customer_repository->find($createdCustomer->id);
            
            if (!empty($clientDeviceToken) && !empty($clientOS)) {
                $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $customerReturned);
            }
            
            $logMessage = 'AuthenticationController - register - Customer register with email: ' . $input['email'] . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
            \Log::info($logMessage);
            
            $customerReturned->token = $token;
            return $this->response->item($customerReturned, $this->customer_transformer);
        }       
    }
    
    public function login()
    {
        $input = $this->request->all();
        $clientDeviceToken = $this->request->header('DEVICE-TOKEN');
        $clientOS = $this->request->header('DEVICE-TYPE');
        
        // Validate login
        $validateType = $this->validateRequest('api-check-login', $input);
        if ($validateType !== true) {
            return $validateType;
        }                
                
        $token  = Password::getRepository()->createNewToken();
        
        $emailAddress = $input['email'];
        $washerObject = $this->washer_repository->findByAttributes(['email' => $emailAddress]);
        
        if ($washerObject) {
            if (Hash::check($input['password'], $washerObject->password)) {
                $this->washer_customer_login_repository->saveTokenLogin($washerObject, $token);
                
                $this->washer_repository->update($this->washer_repository->findByAttributes(['email' => $emailAddress]), [
                    'first_time_login' => 0,
                ]);
                
                $washerObject->token = $token;
                
                if (!empty($clientDeviceToken) && !empty($clientOS)) {
                    $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $washerObject);
                }

                $logMessage = 'AuthenticationController - Login - Washer login with email: ' . $input['email'] . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
                \Log::info($logMessage);
                return $this->response->item($washerObject, $this->washer_transformer);
            } else {
                return Helper::unauthorizedErrorResponse(Helper::LOGIN_FAIL,
                        Helper::LOGIN_FAIL_TITLE,
                        Helper::LOGIN_FAIL_MSG);
            }
        } else {
            $customerObject = $this->customer_repository->findByAttributes(['email' => $emailAddress]);
            if ($customerObject) {
                if (Hash::check($input['password'], $customerObject->password)) {
                    $this->washer_customer_login_repository->saveTokenLogin($customerObject, $token);
                    
                    $this->customer_repository->update($this->customer_repository->findByAttributes(['email' => $emailAddress]), [
                        'first_time_login' => 0,
                    ]);
                    $customerObject->token = $token;
                    
                    if (!empty($clientDeviceToken) && !empty($clientOS)) {
                        $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $customerObject);
                    }
                
                    $logMessage = 'AuthenticationController - Login - Customer login with email: ' . $input['email'] . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
                    \Log::info($logMessage);
                    return $this->response->item($customerObject, $this->customer_transformer);
                } else {
                    return Helper::unauthorizedErrorResponse(Helper::LOGIN_FAIL,
                        Helper::LOGIN_FAIL_TITLE,
                        Helper::LOGIN_FAIL_MSG);
                }
            }else{
                return Helper::unauthorizedErrorResponse(Helper::LOGIN_FAIL,
                        Helper::LOGIN_FAIL_TITLE,
                        Helper::LOGIN_FAIL_MSG);
            }
        }
    }
    
    public function logout() {
        $currentLoggedUser = Helper::getLoggedUser();
        if (!$currentLoggedUser) {
            return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
        }           
        
        $clientDeviceToken = $this->request->header('DEVICE-TOKEN');
        $clientOS = $this->request->header('DEVICE-TYPE');
        if (!empty($clientDeviceToken) && !empty($clientOS)) {
            $this->removeUserDeviceInfo($clientDeviceToken, $clientOS, $currentLoggedUser);
        }
        
        $currentLoggedUser->delete();                
        
        return $this->response->array(['data' => trans('authentication::messages.SUCCESSFUL_LOGOUT')]);
    }       

    public function changePassword() {
        $input = $this->request->all();
        
        $validateType = $this->validateRequest('api-check-change-password', $input);
        if ($validateType !== true) {
            return $validateType;
        } 
        
        $currentLoggedUser = Helper::getLoggedUser();
        if (!$currentLoggedUser) {
            return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
        }                               
        if ($currentLoggedUser->type == 'customer') {
            if (!empty($currentLoggedUser->customer)) {
                $customerObject = $currentLoggedUser->customer;
                
                if (!Hash::check($input['now_password'], $customerObject->password)) {
                    return Helper::badRequestErrorResponse(Helper::WRONG_NOW_PASSWORD,
                        Helper::WRONG_NOW_PASSWORD_TITLE,
                        Helper::WRONG_NOW_PASSWORD_MSG);
                } else {
                    $customerChangePasswordObject = $this->customer_repository->update($customerObject, [
                        'password' => Hash::make($input['password']),
                    ]);
                    $customerChangePasswordObject->token = $currentLoggedUser->token;
                    
                    return $this->response->item($customerChangePasswordObject, $this->customer_transformer);
                }
            } else {
                return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
            }
        } else {

            if (!empty($currentLoggedUser->washer)) {
                $washerObject = $currentLoggedUser->washer;
                if (!Hash::check($input['now_password'], $washerObject->password)) {
                    return Helper::badRequestErrorResponse(Helper::WRONG_NOW_PASSWORD,
                        Helper::WRONG_NOW_PASSWORD_TITLE,
                        Helper::WRONG_NOW_PASSWORD_MSG);
                } else {
                    $washerChangePasswordObject = $this->washer_repository->update($washerObject, [
                        'password' => Hash::make($input['password']),
                    ]);

                    $washerChangePasswordObject->token = $currentLoggedUser->token;
                    return $this->response->item($washerChangePasswordObject, $this->washer_transformer);
                }
            } else {
                return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
            }
        }    
    }
    
     /**
	 *	Authenticate a user based on Facebook access token. If the email address from facebook is already in the database, 
	 *	the facebook user id will be added. 
	 *	If not, a new user will be created with a random password and user info from facebook.
	 */
	public function authenticateFacebook() {

		$input =  $this->request->all();        
        $clientDeviceToken = $this->request->header('DEVICE-TOKEN');
        $clientOS = $this->request->header('DEVICE-TYPE');
        \Log::info('authenticateFacebook - AuthenticationController - $clientDeviceToken = ' . $clientDeviceToken);
        \Log::info('authenticateFacebook - AuthenticationController - $clientOS = ' . $clientOS);
                
        $validateLoginFacebook = $this->validateRequest('api-login-facebook', $input);
        if ($validateLoginFacebook !== true) {
            return $validateLoginFacebook;
        }        

        $facebook = new FacebookWrapper();
        $facebook->loginAsUser($input['access_token']);
        \Log::info('A user call signed in with input: ' . json_encode($input));
        /*
         * Scope email => email
         * me?fields=id,email,first_name,last_name,name,middle_name,gender
         */
        $fields = 'id,email,first_name,last_name,name,middle_name,gender';
        $profile = $facebook->getMe(array(
            'fields' => $fields)
        );

        if ( is_array($profile) && isset($profile['error']) ) {
            $errorArr = array($profile['error']);
            $firstError = 'Can not login facebook, please try again later';
            if (count($errorArr) > 0) {
                $firstError = $errorArr[0];    
            }
            
            return Helper::badRequestErrorResponse(Helper::FACEBOOK_ERROR,
                    Helper::FACEBOOK_ERROR_TITLE,
                    $firstError);
        }

        $token  = Password::getRepository()->createNewToken();
        
        //Log::info( json_encode( $profile->asArray() ) );
        // find customer or washer sticking to the facebook id
        $existingCustomer = Customer::where('facebook_id', '=', $profile->getId())->first();
        $existingWasher = Washer::where('facebook_id', '=', $profile->getId())->first();
        if ($existingCustomer) {                        
            $this->washer_customer_login_repository->saveTokenLogin($existingCustomer, $token);
            $this->customer_repository->update($existingCustomer, [
                'first_time_login' => 0,
            ]);
            $existingCustomer->token = $token;

            if (!empty($clientDeviceToken) && !empty($clientOS)) {
                $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $existingCustomer);
            }
            
            $logMessage = 'AuthenticationController - authenticateFacebook - Customer login with facebook_id: ' . $profile->getId() . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
            \Log::info($logMessage);
            
            return $this->response->item($existingCustomer, $this->customer_transformer);           
        } 
        
        if ($existingWasher) {
            $this->washer_customer_login_repository->saveTokenLogin($existingWasher, $token);
            $this->washer_repository->update($existingWasher, [
                'first_time_login' => 0,
            ]);
            $existingWasher->token = $token;

            if (!empty($clientDeviceToken) && !empty($clientOS)) {
                $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $existingWasher);
            }
            
            $logMessage = 'AuthenticationController - authenticateFacebook - Washer login with facebook_id: ' . $profile->getId() . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
            \Log::info($logMessage);
            
            return $this->response->item($existingWasher, $this->washer_transformer);
        }
        
        // There is no existing customer or washer, create a new one
        // Validate type customer or washer
        $validateType = $this->validateRequest('api-check-type-register', $input);
        if ($validateType !== true) {
            return $validateType;
        }
        
        $type = $input['type'];
        
        // Create an account if none is found        
        $facebook_email = $profile->getProperty('id') . '@facebook.com';                          
                
        $facebook_id = $profile->getId();
        $facebook_password = Hash::make('washmycar#secret');        

        $facebook_image = 'http://graph.facebook.com/' . $profile->getId() . '/picture?width=9999';    
        
        $profileImageFolder = '/profile_facebook_image/';
        if (!is_dir(public_path() . $profileImageFolder)) {
            mkdir(public_path() . $profileImageFolder, 0777, true);
        }

        $userProfileImageFolder = $profileImageFolder . $facebook_id . '/';
        if (!is_dir(public_path() . $userProfileImageFolder)) {
            mkdir(public_path() . $userProfileImageFolder, 0777, true);
        }

        $facebook_image_name = 'avatar_facebook_' . uniqid() . '_' . time() . '.jpg';
        
        $profileImageSaveLinkFull = public_path() . $userProfileImageFolder . $facebook_image_name;
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );                                
        
        $canSaveAvatar = false;
        $client = new \GuzzleHttp\Client();
        try {
            $client->request('GET', $facebook_image, ['sink' => $profileImageSaveLinkFull]);
            $canSaveAvatar = true;
        } catch (Exception $ex) {
            \Log::info('Can not save facebook avatar - authenticateFacebook - AuthenticationController');
        }

        if ($type == 'customer') {
            // Validate customer registration
            $validateCustomer = $this->validateRequest('api-check-customer-facebook-register', $input);
            if ($validateCustomer !== true) {
                return $validateCustomer;
            }
                       
            $facebook_full_name = $input['full_name'];
            
            // Successfull validated data, start to create new washer
            $createdCustomer = $this->customer_repository->create([
                'email' => $facebook_email,
                'password' => $facebook_password,
                'full_name' => $facebook_full_name,
                'phone_number' => $input['phone_number'],   
                'facebook_id' => $facebook_id,
                'type' => WasherCustomerLogin::CUSTOMER_TYPE
            ]);
            
            $this->washer_customer_login_repository->saveTokenLogin($createdCustomer, $token);
            
            if ($facebook_image) {
                if ($canSaveAvatar) {
                    $uploadedFile = new UploadedFile($profileImageSaveLinkFull, $facebook_image_name);
                    Helper::uploadMediaFile($this->file_service, 
                                        $this->file_repository, 
                                        $uploadedFile, 
                                        Customer::ZONE_CUSTOMER_AVATAR_IMAGE, $createdCustomer, Customer::class);
                }
            }
            
            $customerReturned = $this->customer_repository->find($createdCustomer->id);
            
            if (!empty($clientDeviceToken) && !empty($clientOS)) {
                $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $customerReturned);
            }
            
            $logMessage = 'AuthenticationController - authenticateFacebook - Customer register with facebook_id: ' . $profile->getId() . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
            \Log::info($logMessage);
            
            $customerReturned->token = $token;
            return $this->response->item($customerReturned, $this->customer_transformer);
            
        } else if ($type == 'washer') {
            // Validate washer registration
            $validateWasher = $this->validateRequest('api-check-washer-facebook-register', $input);
            if ($validateWasher !== true) {
                return $validateWasher;
            }
            
            $facebook_full_name = $input['full_name'];
            
            // Successfull validated data, start to create new washer
            $createdWasher = $this->washer_repository->create([
                'email' => $facebook_email,
                'password' => $facebook_password,
                'full_name' => $facebook_full_name,
                'phone_number' => $input['phone_number'],
                'employment_type' => $input['employment_type'], 
                'facebook_id' => $facebook_id,
                'type' => WasherCustomerLogin::WASHER_TYPE
            ]);
            
            $this->washer_customer_login_repository->saveTokenLogin($createdWasher, $token);
            
            if ($facebook_image) {
                if ($canSaveAvatar) {
                    $uploadedFile = new UploadedFile($profileImageSaveLinkFull, $facebook_image_name);
                    Helper::uploadMediaFile($this->file_service, 
                                        $this->file_repository, 
                                        $uploadedFile, 
                                        Washer::ZONE_WASHER_AVATAR_IMAGE, $createdWasher, Washer::class);
                }
            }
            
            $washerReturned = $this->washer_repository->find($createdWasher->id);
            
            if (!empty($clientDeviceToken) && !empty($clientOS)) {
                $this->storeUserDeviceInfo($clientDeviceToken, $clientOS, $washerReturned);
            }
            
            $logMessage = 'AuthenticationController - authenticateFacebook - Washer register with facebook_id: ' . $profile->getId() . ', device token: ' . $clientDeviceToken . ', device type: ' . $clientOS;
            \Log::info($logMessage);
            
            $washerReturned->token = $token;
            return $this->response->item($washerReturned, $this->washer_transformer);
        }                                                          
		
	}
    
}


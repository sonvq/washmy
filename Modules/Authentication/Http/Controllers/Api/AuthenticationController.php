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
use Modules\Media\Services\FileService;
use Modules\Media\Repositories\FileRepository;

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
            FileRepository $fileRepository)
    {
        
        $this->request = $request;
        $this->washer_repository = $washerRepository; 
        $this->customer_repository = $customerRepository;
        $this->washer_transformer = $washerTransformerInterface;
        $this->washer_customer_login_repository = $washerCustomerLoginRepository;
        $this->customer_transformer = $customerTransformerInterface;
        $this->file_repository = $fileRepository;
        $this->file_service = $fileService;
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
                        
            return $this->response->item($customerObject, $this->customer_transformer);
        } else if ($currentLoggedUser->type == 'washer') {  
            $washerObject = $currentLoggedUser->member;
            
            $updateRules = [
                'nric_front_image' => 'image|mimes:jpeg,bmp,png,gif|image_extension|max:10240',
                'nric_back_image' => 'image|mimes:jpeg,bmp,png,gif|image_extension|max:10240',
                'avatar' => 'image|mimes:jpeg,bmp,png,gif|image_extension|max:10240',
                'email' => 'email|unique:users,email|unique:agent__agents,email|unique:member__members,email,' . $washerObject->id,
                'phone_country_code' => 'in:' . implode(',', array_keys(config('asgard.core.country_phone_code_list', []))),
                /*
                 * TODO re-validate phone_number min 8
                 */
                'phone_number' => '',
                'id_type' => 'in:nric,co_reg_no',
                'residency_status' => 'in:singapore_citizen,singapore_permanent_resident,foreigner',
                'date_of_birth' => 'date|date_format:Y-m-d'
            ];
            $validator = Validator::make($input, $updateRules);
                        
            if ($validator->fails()) {
                throw new ErrorValidationException(Helper::UNPROCESSABLE_ENTITY, $validator);
            }  
                        
            $this->member_repository->updateMemberProfile($this->file_service, $this->file_repository, $washerObject, $input);
            
            return $this->response->item($washerObject, $this->member_transformer);
        }        
    }
    
    public function register()
    {
        $input =  $this->request->all();        
        $clientDeviceToken = $this->request->header('DEVICE-TOKEN');
        $clientOS = $this->request->header('DEVICE-TYPE');
        
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


}


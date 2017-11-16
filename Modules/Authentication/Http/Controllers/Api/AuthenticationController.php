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
use Hash;
use Modules\Authentication\Entities\WasherCustomerLogin;
use Illuminate\Support\Facades\Password;
use Modules\Authentication\Repositories\WasherCustomerLoginRepository;
use Modules\Customer\Repositories\CustomerRepository;

class AuthenticationController extends BaseController
{
    protected $module_name = 'authentication';
            
    public function __construct(Request $request,  
            WasherRepository $washerRepository,
            CustomerRepository $customerRepository,
            WasherCustomerLoginRepository $washerCustomerLoginRepository,
            WasherTransformerInterface $washerTransformerInterface)
    {
        
        $this->request = $request;
        $this->washer_repository = $washerRepository; 
        $this->customer_repository = $customerRepository;
        $this->washer_transformer = $washerTransformerInterface;
        $this->washer_customer_login_repository = $washerCustomerLoginRepository;
    }
    
    public function register()
    {
        $input =  $this->request->all();        
        
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
            $this->washer_customer_login_repository->saveTokenLogin($createdWasher, $token, WasherCustomerLogin::WASHER_TYPE);
            
            $washerReturned = $this->washer_repository->find($createdWasher->id);
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
            $this->washer_customer_login_repository->saveTokenLogin($createdCustomer, $token, WasherCustomerLogin::CUSTOMER_TYPE);
            
            $customerReturned = $this->customer_repository->find($createdCustomer->id);
            $washerReturned->token = $token;
            return $this->response->item($washerReturned, $this->washer_transformer);
        }       
    }
}

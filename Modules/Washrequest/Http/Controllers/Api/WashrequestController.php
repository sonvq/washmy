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

class WashrequestController extends BaseController
{
    protected $module_name = 'washrequest';
            
    public function __construct(Request $request,  
            WasherRepository $washerRepository,
            CustomerRepository $customerRepository,
            WasherCustomerLoginRepository $washerCustomerLoginRepository,
            WashrequestRepository $washrequestRepository,
            CustomerCarDetailRepository $customerCarDetailRepository,
            
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
                
        $this->washer_transformer = $washerTransformerInterface;
        $this->customer_transformer = $customerTransformerInterface;
        $this->washrequest_transformer = $washrequestTransformerInterface;
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
        $createdWashRequest = $this->wash_request_repository->create($input);
        
        // If save_for_next_time = yes, save car detail for next time
        if (isset($input['save_for_next_time']) && ($input['save_for_next_time'] == 'yes')) {
            if(isset($input['car_plate_no']) && !empty($input['car_plate_no']) 
                    && isset($input['car_color']) && !empty($input['car_color'])) {                
                $createdCustomerCarDetail = $this->customer_car_detail_repository->create([
                    'customer_id' => $currentLoggedUser->customer_id,
                    'car_plate_no' => $input['car_plate_no'],
                    'car_color' => $input['car_color']
                ]);
            }
        }
       
        return $this->response->item($createdWashRequest, $this->washrequest_transformer);   
    }
    

}


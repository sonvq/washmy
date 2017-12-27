<?php

namespace Modules\Customer\Http\Controllers\Api;

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
use Modules\Notify\Repositories\NotifyRepository;
use Modules\Notify\Entities\Notify;
use Modules\Customer\Transformers\CustomerCarDetailTransformerInterface;
use Modules\Customer\Entities\CustomerCarDetail;

class CustomerController extends BaseController
{
    protected $module_name = 'customer';
            
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
            CustomerCarDetailTransformerInterface $customerCarDetailTransformerInterface)
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
        $this->customer_car_detail_transformer = $customerCarDetailTransformerInterface;
    }
    
    public function carDetailList()
    {             
        
        $currentLoggedUser = Helper::getLoggedUser();
        $customerLoggedin = $currentLoggedUser->customer;
        $carDetailList = $customerLoggedin->car_detail;        
        
        return $this->response->collection($carDetailList, $this->customer_car_detail_transformer);   
    }
    
    public function removeCarDetail($id) {
        $carDetailObject = CustomerCarDetail::find($id);
        if(!$carDetailObject) {
            return Helper::notFoundErrorResponse(Helper::CAR_DETAIL_NOT_FOUND,
                        Helper::CAR_DETAIL_NOT_FOUND_TITLE,
                        Helper::CAR_DETAIL_NOT_FOUND_MSG);
        }
        $currentLoggedUser = Helper::getLoggedUser();
        
        if ($carDetailObject->customer_id != $currentLoggedUser->customer_id) {
            return Helper::notFoundErrorResponse(Helper::ONLY_CAR_OWNER_ALLOWED,
                        Helper::ONLY_CAR_OWNER_ALLOWED_TITLE,
                        Helper::ONLY_CAR_OWNER_ALLOWED_MSG);
        }
        
        $carDetailObject->delete();
        
        return $this->response->array(['data' => trans('customer::customers.CAR_DETAIL_DELETED')]);
        
    }

}


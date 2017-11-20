<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Exceptions\CommonException;
use App\Common\Helper;
use Modules\Authentication\Repositories\WasherCustomerLoginRepository;
use Modules\Washer\Repositories\WasherRepository;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Authentication\Entities\WasherCustomerLogin;

class ApiUser {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth, 
            WasherCustomerLoginRepository $washerCustomerLoginRepository,
            WasherRepository $washerRepository,
            CustomerRepository $customerRepository)
	{
		$this->auth = $auth;
        $this->washer_customer_login_repository = $washerCustomerLoginRepository;
        $this->washer_repository = $washerRepository;
        $this->customer_repository = $customerRepository;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(!$request->headers->has('USER-TOKEN')){
            return Helper::unauthorizedErrorResponse(Helper::MISSING_TOKEN,
                    Helper::MISSING_TOKEN_TITLE,
                    Helper::MISSING_TOKEN_MSG);
        }

        $persistence_code = $request->header('USER-TOKEN');
        
        $washerOrCustomerObject = $this->washer_customer_login_repository->findByAttributes(['token' => $persistence_code]);
        
        if (!$washerOrCustomerObject) {
            return Helper::unauthorizedErrorResponse(Helper::INVALID_TOKEN,
                    Helper::INVALID_TOKEN_TITLE,
                    Helper::INVALID_TOKEN_MSG);
        }
        
        if($washerOrCustomerObject->type == WasherCustomerLogin::WASHER_TYPE) {
            $washer = $washerOrCustomerObject->washer;
            
            if (!$washer) {
                return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
            }
        } else if ($washerOrCustomerObject->type == WasherCustomerLogin::CUSTOMER_TYPE) {
            $customer = $washerOrCustomerObject->customer;
            if (!$customer) {
                return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
            }
        } else {
            return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
        }        

        return $next($request);
	}

}

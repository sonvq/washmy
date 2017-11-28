<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Exceptions\CommonException;
use App\Common\Helper;
use Modules\Authentication\Repositories\WasherCustomerLoginRepository;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Washer\Repositories\WasherRepository;

class ApiRequireWasherRole {

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
            CustomerRepository $customerRepository,
            WasherRepository $washerRepository)
	{
		$this->auth = $auth;
        $this->washer_customer_login_repository = $washerCustomerLoginRepository;
        $this->customer_repository = $customerRepository;
        $this->washer_repository = $washerRepository;
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
        
        $customerOrWasherObject = $this->washer_customer_login_repository->findByAttributes(['token' => $persistence_code]);
        
        if (!$customerOrWasherObject) {
            return Helper::unauthorizedErrorResponse(Helper::INVALID_TOKEN,
                    Helper::INVALID_TOKEN_TITLE,
                    Helper::INVALID_TOKEN_MSG);
        }        
        
        if($customerOrWasherObject->type == 'washer') {
            $washer = $customerOrWasherObject->washer;
            if (!$washer) {
                return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
            }
        } else if ($customerOrWasherObject->type == 'customer') {
            return Helper::unauthorizedErrorResponse(Helper::ONLY_WASHER_ROLE_ALLOWED,
                    Helper::ONLY_WASHER_ROLE_ALLOWED_TITLE,
                    Helper::ONLY_WASHER_ROLE_ALLOWED_MSG); 
        } else {
            return Helper::unauthorizedErrorResponse(Helper::USER_NOT_FOUND,
                    Helper::USER_NOT_FOUND_TITLE,
                    Helper::USER_NOT_FOUND_MSG);
        }        

        return $next($request);
	}

}

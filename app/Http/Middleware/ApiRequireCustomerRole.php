<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Common\Helper;
use Modules\Authentication\Repositories\WasherCustomerLoginRepository;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Washer\Repositories\WasherRepository;

class ApiRequireCustomerRole {

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
            throw new CommonException(401, Helper::UNAUTHORIZED);
        }

        $persistence_code = $request->header('USER-TOKEN');
        
        $agentOrMemberObject = $this->agent_member_login_repository->findByAttributes(['token' => $persistence_code]);
        
        if (!$agentOrMemberObject) {
            throw new CommonException(401, Helper::INVALID_TOKEN);
        }
        
        
        if($agentOrMemberObject->type == 'agent') {
            throw new CommonException(403, Helper::ONLY_MEMBER_ROLE_ALLOWED);            
        } else if ($agentOrMemberObject->type == 'member') {
            $member = $agentOrMemberObject->member;
            if (!$member) {
                throw new CommonException(404, Helper::USER_NOT_FOUND);
            }
        } else {
            throw new CommonException(404, Helper::USER_NOT_FOUND);
        }        

        return $next($request);
	}

}

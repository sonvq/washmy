<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Exceptions\CommonException;
use App\Common\Helper;
use Modules\Agent\Repositories\AgentMemberLoginRepository;
use Modules\Agent\Repositories\AgentRepository;
use Modules\Member\Repositories\MemberRepository;

class ApiRequireAgentRole {

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
            AgentMemberLoginRepository $agentMemberLoginRepository,
            AgentRepository $agentRepository,
            MemberRepository $memberRepository)
	{
		$this->auth = $auth;
        $this->agent_member_login_repository = $agentMemberLoginRepository;
        $this->agent_repository = $agentRepository;
        $this->member_repository = $memberRepository;
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
            $agent = $agentOrMemberObject->agent;
            if (!$agent) {
                throw new CommonException(404, Helper::USER_NOT_FOUND);
            }
        } else if ($agentOrMemberObject->type == 'member') {
            throw new CommonException(403, Helper::ONLY_AGENT_ROLE_ALLOWED);
        } else {
            throw new CommonException(404, Helper::USER_NOT_FOUND);
        }        

        return $next($request);
	}

}

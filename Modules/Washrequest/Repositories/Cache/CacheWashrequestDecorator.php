<?php

namespace Modules\Washrequest\Repositories\Cache;

use Modules\Washrequest\Repositories\WashrequestRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheWashrequestDecorator extends BaseCacheDecorator implements WashrequestRepository
{
    public function __construct(WashrequestRepository $washrequest)
    {
        parent::__construct();
        $this->entityName = 'washrequest.washrequests';
        $this->repository = $washrequest;
    }
}

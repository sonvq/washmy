<?php

namespace Modules\Washer\Repositories\Cache;

use Modules\Washer\Repositories\WasherRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheWasherDecorator extends BaseCacheDecorator implements WasherRepository
{
    public function __construct(WasherRepository $washer)
    {
        parent::__construct();
        $this->entityName = 'washer.washers';
        $this->repository = $washer;
    }
}

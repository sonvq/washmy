<?php

namespace Modules\Subscription\Repositories\Cache;

use Modules\Subscription\Repositories\SubscriptionRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheSubscriptionDecorator extends BaseCacheDecorator implements SubscriptionRepository
{
    public function __construct(SubscriptionRepository $subscription)
    {
        parent::__construct();
        $this->entityName = 'subscription.subscriptions';
        $this->repository = $subscription;
    }
}

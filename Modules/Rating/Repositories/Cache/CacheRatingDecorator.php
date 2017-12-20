<?php

namespace Modules\Rating\Repositories\Cache;

use Modules\Rating\Repositories\RatingRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRatingDecorator extends BaseCacheDecorator implements RatingRepository
{
    public function __construct(RatingRepository $rating)
    {
        parent::__construct();
        $this->entityName = 'rating.ratings';
        $this->repository = $rating;
    }
}

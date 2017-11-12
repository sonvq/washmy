<?php

namespace Modules\Authentication\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface WasherCustomerLoginRepository extends BaseRepository
{
    /**
     * @param $object
     * @param $token
     * @param $type
     */
    public function saveTokenLogin($object, $token, $type);
}

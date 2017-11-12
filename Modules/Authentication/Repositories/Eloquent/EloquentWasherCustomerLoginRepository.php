<?php

namespace Modules\Authentication\Repositories\Eloquent;

use Modules\Authentication\Repositories\WasherCustomerLoginRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Authentication\Entities\WasherCustomerLogin;


class EloquentWasherCustomerLoginRepository extends EloquentBaseRepository implements WasherCustomerLoginRepository
{
    /**
     * @param $object
     * @param $token
     * @param $type
     */
    public function saveTokenLogin($object, $token, $type) {
        
        $primaryKey = $type . '_id';
        // Delete all the old token of member or agent type
        WasherCustomerLogin::where($primaryKey, $object->id)->where('type', $type)->delete();
        
        $loginObject = new WasherCustomerLogin();
        $loginObject->$primaryKey = $object->id;        
        $loginObject->token = $token;
        $loginObject->type = $type;
        $loginObject->save();
        
        return $loginObject;
    }
}

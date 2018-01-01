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
     */
    public function saveTokenLogin($object, $token) {
        
        $primaryKey = $object->type . '_id';
        
        //WasherCustomerLogin::where($primaryKey, $object->id)->where('type', $object->type)->delete();
        
        $loginObject = new WasherCustomerLogin();
        $loginObject->$primaryKey = $object->id;        
        $loginObject->token = $token;
        $loginObject->type = $object->type;
        $loginObject->save();
        
        return $loginObject;
    }
}

<?php

namespace Modules\Base\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Modules\User\Entities\Sentinel\User;
use Dingo\Api\Routing\Helpers;
use Validator;
use App\Exceptions\ErrorValidationException;
use App\Common\Helper;

class BaseController extends Controller
{
    use Helpers;
    
    protected $module_name;
    
    protected $validation_rules = [];
    
    protected function validateRequest($rulesName, $input) {
        $rules = config("asgard.$this->module_name.validations.$rulesName.rules", []);
        $messages = config("asgard.$this->module_name.validations.$rulesName.messages", []); 
        
        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return Helper::validationErrorResponse($validator);
        }  
        return true;
    }
}

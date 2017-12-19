<?php

namespace Modules\Reporting\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Modules\User\Entities\Sentinel\User;
use Dingo\Api\Routing\Helpers;
use Modules\Base\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Password;
use App\Common\Helper;
use OneSignal;
use Modules\Reporting\Repositories\ReportingRepository;
use Modules\Reporting\Entities\Reporting;
use Modules\Reporting\Transformers\ReportingTransformerInterface;

class ReportingController extends BaseController
{
    protected $module_name = 'reporting';
            
    public function __construct(Request $request, 
            ReportingRepository $reportingRepository,
            ReportingTransformerInterface $reportingTransformer)
    {
        
        $this->request = $request;
        $this->reporting_repository = $reportingRepository;
        $this->reporting_transformer = $reportingTransformer;
    }
    
    public function create()
    {             
        
       $input =  $this->request->all();                
        
        // Validate type customer or washer
        $validate = $this->validateRequest('api-create-reporting', $input);
        if ($validate !== true) {
            return $validate;
        }
        $currentLoggedUser = Helper::getLoggedUser();
        // Successfull validated data, start to create new reporting
                
        if ($currentLoggedUser->type == 'customer') {
           $input['customer_id'] = $currentLoggedUser->customer_id;
           $input['report_type'] = Reporting::CUSTOMER_MAKE_REPORT;
        } else if ($currentLoggedUser->type == 'washer') {  
            $input['washer_id'] = $currentLoggedUser->washer_id;
            $input['report_type'] = Reporting::WASHER_MAKE_REPORT;
        }  
        
        $createdReporting = $this->reporting_repository->create($input);
        
        return $this->response->item($createdReporting, $this->reporting_transformer);   
    }
    
}


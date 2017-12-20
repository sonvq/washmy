<?php

namespace Modules\Rating\Http\Controllers\Api;

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
use Modules\Rating\Repositories\RatingRepository;
use Modules\Rating\Entities\Rating;
use Modules\Rating\Transformers\RatingTransformerInterface;

class RatingController extends BaseController
{
    protected $module_name = 'rating';
            
    public function __construct(Request $request, 
            RatingRepository $ratingRepository,
            RatingTransformerInterface $ratingTransformer)
    {
        
        $this->request = $request;
        $this->rating_repository = $ratingRepository;
        $this->rating_transformer = $ratingTransformer;
    }
    
    public function create()
    {             
        
       $input =  $this->request->all();                
        
        // Validate type customer or washer
        $validate = $this->validateRequest('api-create-rating', $input);
        if ($validate !== true) {
            return $validate;
        }
        $currentLoggedUser = Helper::getLoggedUser();
        // Successfull validated data, start to create new reporting
                
        $input['customer_id'] = $currentLoggedUser->customer_id;
        
        $createdRating = $this->rating_repository->create($input);
        
        return $this->response->item($createdRating, $this->rating_transformer);   
    }
    
}


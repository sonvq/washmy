<?php

namespace Modules\Subscription\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateSubscriptionRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }



    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }


}

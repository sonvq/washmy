<?php

namespace Modules\Rating\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateRatingRequest extends BaseFormRequest
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

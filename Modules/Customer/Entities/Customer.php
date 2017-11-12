<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customer__customers';
    public $translatedAttributes = [];
    protected $fillable = [];
}

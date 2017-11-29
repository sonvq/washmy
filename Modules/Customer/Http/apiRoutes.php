<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->group(['prefix' => '/customer', 'namespace' => 'Modules\Customer\Http\Controllers\Api'], function ()use ($api) {                        
        
        $api->group(['middleware' => ['apis.frontend', 'apis.frontend.customer']], function () use ($api) {                        
            $api->get('/car-detail-list', ['uses' => 'CustomerController@carDetailList', 'as' => 'api.customer.car-detail-list']);            
        });
    });

});
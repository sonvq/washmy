<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->group(['prefix' => '/wash-request', 'namespace' => 'Modules\Washrequest\Http\Controllers\Api'], function ()use ($api) {                        
        
        $api->group(['middleware' => ['apis.frontend', 'apis.frontend.customer']], function () use ($api) {                        
            $api->post('/create-wash-request', ['uses' => 'WashrequestController@createWashRequest', 'as' => 'api.wash-request.create-wash-request']);            
        });
    });

});
<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->group(['prefix' => '/wash-request', 'namespace' => 'Modules\Washrequest\Http\Controllers\Api'], function ()use ($api) {                        
        
        $api->group(['middleware' => ['apis.frontend', 'apis.frontend.customer']], function () use ($api) {                        
            $api->post('/create-wash-request', ['uses' => 'WashrequestController@createWashRequest', 'as' => 'api.wash-request.create-wash-request']);            
        });
        
        $api->group(['middleware' => ['apis.frontend']], function () use ($api) {                        
            $api->get('/detail/{id}', ['uses' => 'WashrequestController@detailWashRequest', 'as' => 'api.wash-request.detail-wash-request']);            
            $api->get('/list', ['uses' => 'WashrequestController@listWashRequest', 'as' => 'api.wash-request.list-wash-request']);            
        });
    });

});
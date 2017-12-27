<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->group(['prefix' => '/wash-request', 'namespace' => 'Modules\Washrequest\Http\Controllers\Api'], function ()use ($api) {                        
        
        $api->group(['middleware' => ['apis.frontend', 'apis.frontend.customer']], function () use ($api) {                        
            $api->post('/create-wash-request', ['uses' => 'WashrequestController@createWashRequest', 'as' => 'api.wash-request.create-wash-request']);            
            $api->post('/customer-change-request-status/{id}', ['uses' => 'WashrequestController@customerChangeRequestStatus', 'as' => 'api.wash-request.customer-change-request-status']);            
            $api->post('/customer-request-again/{id}', ['uses' => 'WashrequestController@customerRequestAgain', 'as' => 'api.wash-request.customer-request-again']);            
            $api->get('/customer-check-current-wash-request', ['uses' => 'WashrequestController@customerCheckCurrentWashRequest', 'as' => 'api.wash-request.customer-check-current-wash-request']);            
        });
        
        $api->group(['middleware' => ['apis.frontend', 'apis.frontend.washer']], function () use ($api) {                        
            $api->post('/washer-accept-request/{id}', ['uses' => 'WashrequestController@washerAcceptRequest', 'as' => 'api.wash-request.washer-accept-request']);            
            $api->post('/washer-change-request-status/{id}', ['uses' => 'WashrequestController@washerChangeRequestStatus', 'as' => 'api.wash-request.washer-change-request-status']);            
        });
        
        
        $api->group(['middleware' => ['apis.frontend']], function () use ($api) {                        
            $api->get('/detail/{id}', ['uses' => 'WashrequestController@detailWashRequest', 'as' => 'api.wash-request.detail-wash-request']);            
            $api->get('/list', ['uses' => 'WashrequestController@listWashRequest', 'as' => 'api.wash-request.list-wash-request']);            
        });
    });

});
<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->group(['prefix' => '/rating', 'namespace' => 'Modules\Rating\Http\Controllers\Api'], function ()use ($api) {                        
        
        $api->group(['middleware' => ['apis.frontend', 'apis.frontend.customer']], function () use ($api) {                        
            $api->post('/ratings', ['uses' => 'RatingController@create', 'as' => 'api.rating.ratings.create']);            
        });
        
    });

});
<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->group(['prefix' => '/authentication', 'namespace' => 'Modules\Authentication\Http\Controllers\Api'], function ()use ($api) {
        
        $api->post('/register', ['uses' => 'AuthenticationController@register', 'as' => 'api.authentication.register']);
        
        
        $api->group(['middleware' => ['apis.frontend']], function () use ($api) {                        
            $api->get('/logout', ['uses' => 'AuthenticationController@logout', 'as' => 'api.authentication.logout']);                        
        });
    });

});
<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->group(['prefix' => '/authentication', 'namespace' => 'Modules\Authentication\Http\Controllers\Api'], function ()use ($api) {
        
        $api->post('/register', ['uses' => 'AuthenticationController@register', 'as' => 'api.authentication.register']);
        $api->post('/login', ['uses' => 'AuthenticationController@login', 'as' => 'api.authentication.login']);
        
        $api->group(['middleware' => ['apis.frontend']], function () use ($api) {                        
            $api->get('/logout', ['uses' => 'AuthenticationController@logout', 'as' => 'api.authentication.logout']);                        
            $api->post('/update-profile', ['uses' => 'AuthenticationController@updateProfile', 'as' => 'api.authentication.update.profile']);
            $api->get('/get-profile-customer/{id}', ['uses' => 'AuthenticationController@getProfileCustomer', 'as' => 'api.authentication.get.profile.customer']);
            $api->get('/get-profile-washer/{id}', ['uses' => 'AuthenticationController@getProfileWasher', 'as' => 'api.authentication.get.profile.washer']);
            $api->post('/change-password', ['uses' => 'AuthenticationController@changePassword', 'as' => 'api.authentication.change.password']);
        });
                
        
    });

});
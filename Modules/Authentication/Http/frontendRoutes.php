<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'authentication'], function (Router $router) {
   
    $router->get('reset/{type}/{id}/{token}', ['as' => 'authentication.reset.complete', 'uses' => 'AuthenticationController@getResetComplete']);
    $router->post('reset/{type}/{id}/{token}', ['as' => 'authentication.reset.complete.post', 'uses' => 'AuthenticationController@postResetComplete']);
    $router->get('payment-process', ['as' => 'authentication.payment.process', 'uses' => 'AuthenticationController@getPaymentProcess']);
});

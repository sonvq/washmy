<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/subscription'], function (Router $router) {
    $router->bind('subscription', function ($id) {
        return app('Modules\Subscription\Repositories\SubscriptionRepository')->find($id);
    });
    $router->get('subscriptions', [
        'as' => 'admin.subscription.subscription.index',
        'uses' => 'SubscriptionController@index',
        'middleware' => 'can:subscription.subscriptions.index'
    ]);
    $router->get('subscriptions/create', [
        'as' => 'admin.subscription.subscription.create',
        'uses' => 'SubscriptionController@create',
        'middleware' => 'can:subscription.subscriptions.create'
    ]);
    $router->post('subscriptions', [
        'as' => 'admin.subscription.subscription.store',
        'uses' => 'SubscriptionController@store',
        'middleware' => 'can:subscription.subscriptions.create'
    ]);
    $router->get('subscriptions/{subscription}/edit', [
        'as' => 'admin.subscription.subscription.edit',
        'uses' => 'SubscriptionController@edit',
        'middleware' => 'can:subscription.subscriptions.edit'
    ]);
    $router->put('subscriptions/{subscription}', [
        'as' => 'admin.subscription.subscription.update',
        'uses' => 'SubscriptionController@update',
        'middleware' => 'can:subscription.subscriptions.edit'
    ]);
    $router->delete('subscriptions/{subscription}', [
        'as' => 'admin.subscription.subscription.destroy',
        'uses' => 'SubscriptionController@destroy',
        'middleware' => 'can:subscription.subscriptions.destroy'
    ]);
// append

});

<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/washrequest'], function (Router $router) {
    $router->bind('washrequest', function ($id) {
        return app('Modules\Washrequest\Repositories\WashrequestRepository')->find($id);
    });
    $router->get('washrequests', [
        'as' => 'admin.washrequest.washrequest.index',
        'uses' => 'WashrequestController@index',
        'middleware' => 'can:washrequest.washrequests.index'
    ]);
    $router->get('washrequests/create', [
        'as' => 'admin.washrequest.washrequest.create',
        'uses' => 'WashrequestController@create',
        'middleware' => 'can:washrequest.washrequests.create'
    ]);
    $router->post('washrequests', [
        'as' => 'admin.washrequest.washrequest.store',
        'uses' => 'WashrequestController@store',
        'middleware' => 'can:washrequest.washrequests.create'
    ]);
    $router->get('washrequests/{washrequest}/edit', [
        'as' => 'admin.washrequest.washrequest.edit',
        'uses' => 'WashrequestController@edit',
        'middleware' => 'can:washrequest.washrequests.edit'
    ]);
    $router->put('washrequests/{washrequest}', [
        'as' => 'admin.washrequest.washrequest.update',
        'uses' => 'WashrequestController@update',
        'middleware' => 'can:washrequest.washrequests.edit'
    ]);
    $router->delete('washrequests/{washrequest}', [
        'as' => 'admin.washrequest.washrequest.destroy',
        'uses' => 'WashrequestController@destroy',
        'middleware' => 'can:washrequest.washrequests.destroy'
    ]);
// append

});

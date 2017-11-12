<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/washer'], function (Router $router) {
    $router->bind('washer', function ($id) {
        return app('Modules\Washer\Repositories\WasherRepository')->find($id);
    });
    $router->get('washers', [
        'as' => 'admin.washer.washer.index',
        'uses' => 'WasherController@index',
        'middleware' => 'can:washer.washers.index'
    ]);
    $router->get('washers/create', [
        'as' => 'admin.washer.washer.create',
        'uses' => 'WasherController@create',
        'middleware' => 'can:washer.washers.create'
    ]);
    $router->post('washers', [
        'as' => 'admin.washer.washer.store',
        'uses' => 'WasherController@store',
        'middleware' => 'can:washer.washers.create'
    ]);
    $router->get('washers/{washer}/edit', [
        'as' => 'admin.washer.washer.edit',
        'uses' => 'WasherController@edit',
        'middleware' => 'can:washer.washers.edit'
    ]);
    $router->put('washers/{washer}', [
        'as' => 'admin.washer.washer.update',
        'uses' => 'WasherController@update',
        'middleware' => 'can:washer.washers.edit'
    ]);
    $router->delete('washers/{washer}', [
        'as' => 'admin.washer.washer.destroy',
        'uses' => 'WasherController@destroy',
        'middleware' => 'can:washer.washers.destroy'
    ]);
// append

});

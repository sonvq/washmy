<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/reporting'], function (Router $router) {
    $router->bind('reporting', function ($id) {
        return app('Modules\Reporting\Repositories\ReportingRepository')->find($id);
    });
    $router->get('reportings', [
        'as' => 'admin.reporting.reporting.index',
        'uses' => 'ReportingController@index',
        'middleware' => 'can:reporting.reportings.index'
    ]);
    $router->get('reportings/create', [
        'as' => 'admin.reporting.reporting.create',
        'uses' => 'ReportingController@create',
        'middleware' => 'can:reporting.reportings.create'
    ]);
    $router->post('reportings', [
        'as' => 'admin.reporting.reporting.store',
        'uses' => 'ReportingController@store',
        'middleware' => 'can:reporting.reportings.create'
    ]);
    $router->get('reportings/{reporting}/edit', [
        'as' => 'admin.reporting.reporting.edit',
        'uses' => 'ReportingController@edit',
        'middleware' => 'can:reporting.reportings.edit'
    ]);
    $router->put('reportings/{reporting}', [
        'as' => 'admin.reporting.reporting.update',
        'uses' => 'ReportingController@update',
        'middleware' => 'can:reporting.reportings.edit'
    ]);
    $router->delete('reportings/{reporting}', [
        'as' => 'admin.reporting.reporting.destroy',
        'uses' => 'ReportingController@destroy',
        'middleware' => 'can:reporting.reportings.destroy'
    ]);
// append

});

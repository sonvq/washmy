<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/rating'], function (Router $router) {
    $router->bind('rating', function ($id) {
        return app('Modules\Rating\Repositories\RatingRepository')->find($id);
    });
    $router->get('ratings', [
        'as' => 'admin.rating.rating.index',
        'uses' => 'RatingController@index',
        'middleware' => 'can:rating.ratings.index'
    ]);
    $router->get('ratings/create', [
        'as' => 'admin.rating.rating.create',
        'uses' => 'RatingController@create',
        'middleware' => 'can:rating.ratings.create'
    ]);
    $router->post('ratings', [
        'as' => 'admin.rating.rating.store',
        'uses' => 'RatingController@store',
        'middleware' => 'can:rating.ratings.create'
    ]);
    $router->get('ratings/{rating}/edit', [
        'as' => 'admin.rating.rating.edit',
        'uses' => 'RatingController@edit',
        'middleware' => 'can:rating.ratings.edit'
    ]);
    $router->put('ratings/{rating}', [
        'as' => 'admin.rating.rating.update',
        'uses' => 'RatingController@update',
        'middleware' => 'can:rating.ratings.edit'
    ]);
    $router->delete('ratings/{rating}', [
        'as' => 'admin.rating.rating.destroy',
        'uses' => 'RatingController@destroy',
        'middleware' => 'can:rating.ratings.destroy'
    ]);
// append

});

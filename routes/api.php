<?php

use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\OrdernotesController;

$api = app(Dingo\Api\Routing\Router::class);

$api->version('v1', ['middleware' => ['bindings']], function ($api) {

    // AUTH Routes
    $api->post('signin', 'App\Http\Controllers\Api\AuthController@signin');
    $api->post('register', 'App\Http\Controllers\Api\AuthController@register');
    $api->post('recovery', 'App\Http\Controllers\Api\AuthController@recovery');
    $api->post('reset', 'App\Http\Controllers\Api\AuthController@reset');

    $middlware = [
        'before' => 'jwt.auth',
        //'after' => 'jwt.refresh',
    ];

    $api->group(['middleware' => $middlware], function ($api) {
        // USERS routes
        $api->resource(
            'users',
            UsersController::class
        );

        // LOCATIONS routes
        $api->resource(
            'locations',
            LocationsController::class
        );

        // ORDERS routes
        $api->patch('orders/{order}/deliver/', ['as' => 'orders.deliver', 'uses' => 'OrdersController@deliver']);
        $api->resource('orders', OrdersController::class,
            ['only' => ['index', 'show', 'store', 'update']]
        );

        // NOTES routes
        $api->resource('notes', OrdernotesController::class,
            ['only' => ['store', 'show', 'update']]
        );

        // STUB routes
        $api->get('orders/{order}/relationships/location', ['as' => 'orders.relationships.location']);
        $api->get('orders/{order}/location', ['as' => 'orders.location']);
        $api->get('orders/{order}/relationships/user', ['as' => 'orders.relationships.user']);
        $api->get('orders/{order}/user', ['as' => 'orders.user']);
        $api->get('orders/{order}/relationships/notes', ['as' => 'orders.relationships.notes']);
        $api->get('orders/{order}/notes', ['as' => 'orders.notes']);

    });
});


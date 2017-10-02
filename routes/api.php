<?php

use App\Http\Middleware\AuthJWT;
use App\Http\Middleware\VerifyContentType;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Router as Dingo;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\NoteController;

$api = app(Dingo::class);

$api->version('v1', function ($api) {

    // STUB routes
    $api->get('orders/{order}/relationships/location', ['as' => 'orders.relationships.location']);
    $api->get('orders/{order}/location', ['as' => 'orders.location']);
    $api->get('orders/{order}/relationships/user', ['as' => 'orders.relationships.user']);
    $api->get('orders/{order}/user', ['as' => 'orders.user']);
    $api->get('orders/{order}/relationships/notes', ['as' => 'orders.relationships.notes']);
    $api->get('orders/{order}/notes', ['as' => 'orders.notes']);
    // END STUB routes

    $api->resource(
        'sessions',
        SessionController::class,
        ['only' => ['store', 'show']]
    );

    $api->resource(
        'users',
        UserController::class
    );

    $api->resource(
        'locations',
        LocationController::class
    );

    $api->group(['middleware' => AuthJWT::class], function ($api) {

        $api->resource(
            'orders',
            OrderController::class
        );

        $api->resource(
            'notes',
            NoteController::class
        );

    });
});

//Route::namespace('Api')
//    ->prefix('v1')
//    ->group(function () {
//        Route::group(['middleware' => VerifyContentType::class], function () {
//
//            // STUB routes
//            Route::get('orders/{order}/relationships/location', ['as' => 'orders.relationships.location']);
//            Route::get('orders/{order}/location', ['as' => 'orders.location']);
//            Route::get('orders/{order}/relationships/user', ['as' => 'orders.relationships.user']);
//            Route::get('orders/{order}/user', ['as' => 'orders.user']);
//            Route::get('orders/{order}/relationships/notes', ['as' => 'orders.relationships.notes']);
//            Route::get('orders/{order}/notes', ['as' => 'orders.notes']);
//            // END STUB routes
//
//            Route::resource(
//                'sessions',
//                'SessionController',
//                ['only' => ['store', 'show']]
//            );
//
//            Route::resource(
//                'users',
//                'UserController'
//            );
//
//            Route::resource(
//                'locations',
//                'LocationController'
//            );
//
//            Route::group(['middleware' => AuthJWT::class], function () {
//
//                Route::resource(
//                    'orders',
//                    'OrderController'
//                );
//
//                Route::resource(
//                    'notes',
//                    'NoteController'
//                );
//
//            });
//        });
//    });
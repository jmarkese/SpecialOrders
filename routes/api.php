<?php

use App\Http\Middleware\AuthJWT;
use App\Http\Middleware\VerifyContentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\SessionsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\OrdernotesController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'bindings'], function ($api) {
    //dd("HERE routes");
    $api->get('test', function(){
        dd("HERE endpoint");
    });

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
        SessionsController::class,
        ['only' => ['store', 'show']]
    );

    $api->resource(
        'users',
        UsersController::class
    );

    $api->resource(
        'locations',
        LocationsController::class
    );

    $api->group(['middleware' => AuthJWT::class], function ($api) {

        $api->patch('orders/{order}/deliver/', ['as' => 'orders.deliver', 'uses' => 'OrdersController@deliver']);
        $api->resource('orders', OrdersController::class,
            ['only' => ['index', 'show', 'store', 'update']]
        );

        $api->resource('notes', OrdernotesController::class,
            ['only' => ['store', 'show', 'update']]
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
//                'users',
//                'UsersController'
//            );
//
//            Route::resource(
//                'locations',
//                'LocationsController'
//            );
//
//            Route::group(['middleware' => AuthJWT::class], function () {
//
//                Route::patch('orders/{order}/deliver/', ['as' => 'orders.deliver', 'uses' => 'OrdersController@deliver']);
//
//                Route::resource(
//                    'orders',
//                    'OrdersController',
//                    ['only' => ['index', 'store', 'show', 'update']]
//                );
//
//                Route::resource(
//                    'notes',
//                    'OrdernotesController',
//                    ['only' => ['store', 'show', 'update']]
//                );
//
//                /*
//                Route::patch('orders/{order}/deliver/', ['as' => 'orders.deliver', 'uses' => 'OrdersController@deliver']);
//
//                Route::get('orders', 'OrdersController@index')
//                    ->name('orders.index')
//                    ->middleware('can:location_order');
//
//                Route::get('orders/{order}', 'OrdersController@show')
//                    ->name('orders.show')
//                    ->middleware('can:location_order,order')
//                    ->middleware('can:show_orders')
//                ;
//                //Route::get('orders/{order}', ['as' => 'orders.show', 'uses' => 'OrdersController@show']);
//                Route::post('orders', ['as' => 'orders.store', 'uses' => 'OrdersController@store']);
//                Route::patch('orders/{order}', ['as' => 'orders.update', 'uses' => 'OrdersController@update']);
//
//                Route::get('orders/{order}/notes/{ordernote}', ['as' => 'orders.notes.show', 'uses' => 'OrdernotesController@show']);
//                Route::post('orders', ['as' => 'orders.notes.store', 'uses' => 'OrdernotesController@store']);
//                 * */
//
//            });
//        });
//    });

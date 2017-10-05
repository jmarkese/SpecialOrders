<?php

use App\Http\Middleware\AuthJWT;
use App\Http\Middleware\VerifyContentType;
use Illuminate\Http\Request;

Route::namespace('Api')
    ->prefix('v1')
    ->group(function () {
        Route::group(['middleware' => VerifyContentType::class], function () {

            // STUB routes
            Route::get('orders/{order}/relationships/location', ['as' => 'orders.relationships.location']);
            Route::get('orders/{order}/location', ['as' => 'orders.location']);
            Route::get('orders/{order}/relationships/user', ['as' => 'orders.relationships.user']);
            Route::get('orders/{order}/user', ['as' => 'orders.user']);
            Route::get('orders/{order}/relationships/notes', ['as' => 'orders.relationships.notes']);
            Route::get('orders/{order}/notes', ['as' => 'orders.notes']);

            // END STUB routes

            Route::resource(
                'users',
                'UsersController'
            );

            Route::resource(
                'locations',
                'LocationsController'
            );

            Route::group(['middleware' => AuthJWT::class], function () {

                Route::patch('orders/{order}/deliver/', ['as' => 'orders.deliver', 'uses' => 'OrdersController@deliver']);

                Route::resource(
                    'orders',
                    'OrdersController',
                    ['only' => ['index', 'store', 'show', 'update']]
                );

                Route::resource(
                    'notes',
                    'OrdernotesController',
                    ['only' => ['store', 'show', 'update']]
                );

                /*
                Route::patch('orders/{order}/deliver/', ['as' => 'orders.deliver', 'uses' => 'OrdersController@deliver']);

                Route::get('orders', 'OrdersController@index')
                    ->name('orders.index')
                    ->middleware('can:location_order');

                Route::get('orders/{order}', 'OrdersController@show')
                    ->name('orders.show')
                    ->middleware('can:location_order,order')
                    ->middleware('can:show_orders')
                ;
                //Route::get('orders/{order}', ['as' => 'orders.show', 'uses' => 'OrdersController@show']);
                Route::post('orders', ['as' => 'orders.store', 'uses' => 'OrdersController@store']);
                Route::patch('orders/{order}', ['as' => 'orders.update', 'uses' => 'OrdersController@update']);

                Route::get('orders/{order}/notes/{ordernote}', ['as' => 'orders.notes.show', 'uses' => 'OrdernotesController@show']);
                Route::post('orders', ['as' => 'orders.notes.store', 'uses' => 'OrdernotesController@store']);
                 * */

            });
        });
    });
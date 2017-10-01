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
                'sessions',
                'SessionController',
                ['only' => ['store', 'show']]
            );

            Route::resource(
                'users',
                'UserController'
            );

            Route::resource(
                'locations',
                'LocationController'
            );

            Route::group(['middleware' => AuthJWT::class], function () {

                Route::resource(
                    'orders',
                    'OrderController'
                );

                Route::resource(
                    'notes',
                    'NoteController'
                );

            });
        });
    });
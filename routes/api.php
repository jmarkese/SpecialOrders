<?php

use App\Http\Middleware\AuthJWT;
use App\Http\Middleware\VerifyContentType;
use Illuminate\Http\Request;

Route::namespace('Api')
    ->prefix('v1')
    ->group(function () {
        Route::group(['middleware' => VerifyContentType::class], function () {

            Route::resource(
                'sessions',
                'SessionController',
                ['only' => ['store', 'show']]
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
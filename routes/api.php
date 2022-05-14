<?php

use Illuminate\Support\Facades\Route;

$middlewares = [];
$middlewares[] = 'json';

if (env('APP_ENV') !== 'local') {
    $middlewares[] = 'auth:api';
}

Route::middleware($middlewares)
    ->prefix('v1')
    ->group(function() {
        Route::middleware('is-professional')
            ->namespace('Professionals')
            ->group( function() {
                Route::get('/', function () {
                    return 'Tem acesso mas não possui nada aqui';
                });

                /** Profile Professional */
                Route::get('/profile', 'ProfileController@profile');
                Route::post('/profile/update', 'ProfileController@update');

                /** Store */
                Route::get('/stores', 'StoresController@list');
                Route::get('/stores/all', 'StoresController@listAll');
                Route::get('/store/{id}', 'StoresController@view');
            });

            Route::middleware('is-store')
                ->namespace('Stores')
                ->group( function() {
                    Route::get('/', function () {
                        return 'Tem acesso mas não possui nada aqui';
                    });
                });

        Route::get('marital-status', 'GeneralDataController@maritalStatus')->name('marital-status');
        Route::get('segments', 'GeneralDataController@segments')->name('segments');
        Route::get('regions', 'GeneralDataController@regions')->name('regions');
        Route::get('occupations', 'GeneralDataController@occupations')->name('occupations');
        Route::get('genders', 'GeneralDataController@genders')->name('genders');

        /** Experiências e prêmios bônus */
        Route::get('awards', 'AwardsController@list')->name('awards');
        Route::get('award/{id}', 'AwardsController@view')->name('awards.view');
        Route::get('awards/categories', 'GeneralDataController@genders')->name('genders');

    });

/**
 * Route validation and authentication
 */
Route::post('login', 'Auth\\LoginController@login')->name('login');

Route::get('unauthenticated', fn () => response()->json(['message' => 'unauthenticated'], 402))->name('unauthenticated');
Route::get('unauthorized', fn () => response()->json(['message' => 'unauthorized'], 413))->name('unauthorized');


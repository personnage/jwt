<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('register', 'Auth\AuthController@register');

    Route::group(['prefix' => 'token', 'namespace' => 'Auth'], function () {
        Route::get('payload', 'TokenController@payload');
        Route::get('refresh', 'TokenController@refresh');
        Route::post('refresh', 'TokenController@forceRefresh');
    });

    // Restricted
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('home', 'HomeController@index');
    });

    Route::get('/', function () {
        return ['Welcome to API'];
    });
});

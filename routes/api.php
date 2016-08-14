<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('password/email', 'PasswordController@sendResetLinkEmail');
    });

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

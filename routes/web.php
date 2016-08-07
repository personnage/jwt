<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    // free resource...
    return view('welcome');
});

Route::post('join', 'AuthenticateController@register');
Route::post('login', 'AuthenticateController@login');
Route::get('restricted', 'HomeController@index');

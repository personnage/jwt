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

// Authentication Routes...
Route::post('login', 'Auth\AuthController@login');
// Registration Routes...
Route::post('register', 'Auth\AuthController@register');

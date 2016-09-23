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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',function(){
    return view('login');
});

Route::get('/signup',function(){
    return view('signup');
});

Route::group(['middleware' => 'web'], function() {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});*/


Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function() {

    Route::get('cities/all', 'MiscellaneousController@getCityList');

    // TODO: Write a middleware for access controlling later
    // --Tested!
    Route::group([], function() {
        Route::get('users/get/all', 'UserController@getAllUsers');
        Route::get('users/get/user_id/{id}', 'UserController@getUserByID');
        Route::post('users/create/new', 'UserController@createNewUser');
        Route::put('users/update/user_id/{id}', 'UserController@updateUser');
        Route::patch('users/regen_auth/user_id/{id}', 'UserController@regenerateUserAuth');
        Route::delete('users/delete/user_id/{id}', 'UserController@deleteUser');
    });
});



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

    // CHANGED : Auth:api was removed temporarily for faster development and testing.
    // TODO : Enable 'middleware' => 'auth:api' again.

Route::group(['prefix' => 'api/v1'], function() {

    // Every table that doesnt expose inserts/updates to the client goes to MiscellaneousController
    Route::get('cities/all', 'MiscellaneousController@getCityList');
    Route::get('categories/all', 'MiscellaneousController@getCategoryList');
    Route::get('business/categories/all', 'MiscellaneousController@getBusinessCategoryList');

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

     // --Tested! --Nilesh Jayananandana
    Route::group(['prefix' => 'product'], function() {
        Route::get('all', 'ProductController@index');
        Route::get('product_id/{id}', 'ProductController@show');
        Route::post('create/new', 'ProductController@create');
        Route::post('update/{id}', 'ProductController@update');
        // TODO: Add a product Remove
    });

    Route::group(['prefix' => 'brand'], function(){
        Route::get('all', 'BrandController@index');
         // TODO: Insert , Update, Delete
    });

    // --Tested! --Nilesh Jayananandana
    Route::group(['prefix' => 'template'], function() {
        Route::get('all', 'TemplateController@index');
        Route::post('create/new', 'TemplateController@create');
    });

    Route::group(['prefix' => 'order'], function() {
        Route::get('all', 'OrderController@index');
        Route::post('update/{id}', 'OrderController@update'); // Why POST? Patch is the proper verb.
    });

    // TO be tested
    Route::group(['prefix' => 'business'], function() {
        Route::get('details/user_id/{id}', 'BusinessController@show');
        Route::post('update/business_id/{id}', 'BusinessController@update');
    });

    // To be tested
    Route::group(['prefix' => 'profile'], function() {
        Route::get('details/user_id/{id}', 'UserController@getUserByID');
        Route::post('update/business_id/{id}', 'UserController@updateUser');
    });
});



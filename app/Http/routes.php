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

    // Every table that doesn't expose inserts/ updates to the client goes to MiscellaneousController.
    // TO be tested
    Route::get('cities/all', 'MiscellaneousController@getCityList');
    
    // --Tested! --Nilesh Jayananandana
    Route::get('categories/all', 'MiscellaneousController@getCategoryList');

    // TO be tested
    Route::get('business/categories/all', 'MiscellaneousController@getBusinessCategoryList');

    // TODO: Write a middleware for access controlling later
    // --Tested!
    Route::group([], function() {
        Route::get('users/get/all', 'UserController@getAllUsers');
        Route::get('users/get/user_id/{id}', 'UserController@getUserByID');
        Route::post('users/create/new', 'UserController@createNewUser');    // Modified and tested
        Route::put('users/update/user_id/{id}', 'UserController@updateUser');
        Route::patch('users/regen_auth', 'UserController@regenerateUserAuth');  // DO NOT USE AUTH MIDDLEWARE
        Route::patch('users/password/change', 'UserController@changePassword'); // USE AUTH MIDDLEWARE
        // Route::patch('users/password/reset', 'UserController@resetPassword'); // DO NOT USE AUTH MIDDLEWARE
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

    // TO be tested
    Route::group(['prefix' => 'brand'], function(){
        // --Tested! --Nilesh Jayananandana
        Route::get('all', 'BrandController@index');
        // TO be tested
        Route::post('create/new', 'BrandController@create');
        Route::post('update/brand_id/{id}', 'BrandController@update');
        Route::post('delete/brand_id/{id}', 'BrandController@destroy');

    });

    // --Tested! --Nilesh Jayananandana
    Route::group(['prefix' => 'template'], function() {
        Route::get('all', 'TemplateController@index');
        Route::post('create/new', 'TemplateController@create');
    });

    Route::group(['prefix' => 'order'], function() {
        Route::get('all', 'OrderController@index');
        Route::get('products/order_id/{id}', 'OrderController@getOrderProducts');
        Route::post('create/new', 'OrderController@create');
        Route::post('update/order_id/{id}', 'OrderController@update'); // Why POST? Patch is the proper verb.
    });

    // TO be tested
    Route::group(['prefix' => 'business'], function() {
        Route::get('all', 'BusinessController@index');
        Route::get('details/user_id/{id}', 'BusinessController@show');
        Route::post('update/business_id/{id}', 'BusinessController@update');
    });

    // To be tested
    Route::group(['prefix' => 'profile'], function() {
        Route::get('details/user_id/{id}', 'UserController@getUserByID');
        Route::post('update/user_id/{id}', 'UserController@updateUser');
        Route::post('details/auth_regen/user_id/{id}', 'UserController@updateUser');
    });
});



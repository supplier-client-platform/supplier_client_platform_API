<?php

use Vinkla\Pusher\Facades\Pusher; // ONLY FOR TESTING PURPOSES!
use Illuminate\Support\Facades\Mail; // ONLY FOR TESTING PURPOSES!

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

    // --Tested!
    Route::group([], function() {
        Route::get('users/get/all', 'UserController@getAllUsers');
        Route::get('users/get/user_id/{id}', 'UserController@getUserByID');
        Route::post('users/create/new', 'UserController@createNewUser');    // Modified and tested
        Route::put('users/update/user_id/{id}', 'UserController@updateUser');
        Route::post('users/regen_auth', 'UserController@regenerateUserAuth');  // DO NOT USE AUTH MIDDLEWARE
        Route::post('users/password/change', 'UserController@changePassword'); // USE AUTH MIDDLEWARE
        Route::post('users/password/reset', 'UserController@resetPassword'); // DO NOT USE AUTH MIDDLEWARE
        Route::delete('users/delete/user_id/{id}', 'UserController@deleteUser');
    });

    // --Tested! --Nilesh Jayananandana
    Route::group(['prefix' => 'product'], function() {
        Route::get('all', 'ProductController@index');
        Route::get('product_id/{id}', 'ProductController@show');
        Route::post('create/new', 'ProductController@create');
        Route::post('update/{id}', 'ProductController@update');
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


    Route::group(['prefix' => 'customer'], function() {
        Route::post('create/new', 'CustomerController@create');
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
        Route::post('branch/create/{id}', 'BusinessController@branchCreate');
        Route::post('branch/update/{id}', 'BusinessController@branchUpdate');
        Route::get('branch/list/{id}', 'BusinessController@branchList');
        Route::get('branch/delete/{id}', 'BusinessController@branchDelete');
    });

    // To be tested
    Route::group(['prefix' => 'profile'], function() {
        Route::get('details/user_id/{id}', 'UserController@getUserByID');
        Route::post('update/user_id/{id}', 'UserController@updateUser');
        Route::post('details/auth_regen/user_id/{id}', 'UserController@updateUser');
    });

    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('order_stats/supplier/{id}', 'DashboardController@orders');
        Route::get('sales_stats/supplier/{id}', 'DashboardController@sales');
        Route::get('widget_stats/supplier/{id}', 'DashboardController@statsWidget');
        Route::get('sidebar/supplier/{id}', 'DashboardController@sidebar');
    });

    Route::group(['prefix' => 'reports'], function() {
        Route::POST('order_reports/supplier/{id}', 'ReportController@orders');
        Route::POST('brand_reports/supplier/{id}', 'ReportController@brands');
        Route::POST('product_reports/supplier/{id}', 'ReportController@products');
    });

    // TODO : Remove these methods; they are only for testing.
    // pass customer id here.
    Route::get('testPusher_mobile/{id}', function($id) {
        $message_common = "We are sorry, your order was turned down because reasons";
        // Send notification to mobile
        Pusher::trigger('order', 'order_mobile_notifications'.$id, ['message' => $message_common]);
    });

    Route::get('testPusher_web', function() {
        $message_common = "Pusher working!";
        // Send notification to web
        Pusher::trigger('order', 'order_web
        _notifications', ['message' => $message_common]);
    });

    Route::get('test_mail', function() {

        $new_user = [
            'name' => 'test',
            'email' => 'danurajay@gmail.com'
        ];

        Mail::send('emails.welcome', ['data' => $new_user], function ($m) use ($new_user) {
            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));

            $m->to($new_user['email'], $new_user['email'])->subject('Welcome to Supplier Client Platform!');
        });
    });
});



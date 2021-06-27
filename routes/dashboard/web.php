<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function()
{

    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

        Route::get('/', 'DashboardController@index')->name('index');
        Route::resource('users', 'UserController')->names('user');
        Route::resource('categories', 'CategoryController')->names('category');
        Route::resource('products', 'ProductController')->names('product');
        Route::resource('clients', 'ClientController')->names('client');
        Route::resource('client.order', 'Client\\OrderController')->names('client.order');
        Route::get('orders', 'OrderController@index')->name('order.index');
        Route::get('orders/{order}/products', 'OrderController@product')->name('order.product');


    });

});


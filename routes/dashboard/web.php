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


    });

});


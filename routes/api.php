<?php

use Illuminate\Http\Request;

Route::post('/install', 'API\InstallController@install');
Route::post('/testDB', 'API\InstallController@testDB');

Route::prefix('auth')->group(function () {
    Route::post('register', 'API\RegisterController@register');
    Route::post('login', 'API\RegisterController@login');
    
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'API\RegiSterController@logout');
    });
});
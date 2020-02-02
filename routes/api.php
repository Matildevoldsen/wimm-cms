<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('auth')->group(function () {
    Route::post('register', 'API\RegisterController@register');
    Route::post('login', 'API\RegisterController@login');

    Route::middleware('auth:api')->group(function () {
        Route::get('dates', 'API\UserController@userDatesReadable');
        Route::get('info', 'API\UserController@user');
        Route::get('logout', 'API\RegiSterController@logout');

        Route::middleware('admin')->group(function () {
            Route::prefix('admin')->group(function () {
                Route::post('topCategory/new', 'API\TopCategoryController@store');
                Route::post('category/new', 'API\CategoryController@store');
                Route::post('article/new', 'API\ArticleController@store');

                Route::get('stats/thisMonth', 'API\StatsController@getStatsForFullMonth');
            });
        });
    });
});

Route::get('topCategory/all', 'API\TopCategoryController@all');
Route::get('topCategory/{id}', 'API\TopCategoryController@view');

Route::get('category/all', 'API\CategoryController@all');
Route::get('category/{id}', 'API\CategoryController@view');

Route::get('article/all', 'API\ArticleController@all');
Route::get('article/{id}', 'API\ArticleController@view');

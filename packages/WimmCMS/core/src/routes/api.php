<?php

use WimmCMS\core\Http\Controllers\AboutController;
use WimmCMS\core\Http\Controllers\StatsController;
use WimmCMS\core\Http\Controllers\ArticleController;
use WimmCMS\core\Http\Controllers\CategoryController;
use WimmCMS\core\Http\Controllers\ContactController;
use WimmCMS\core\Http\Controllers\HomeController;
use WimmCMS\core\Http\Controllers\SettingController;
use WimmCMS\core\Http\Controllers\TopCategoryController;
use WimmCMS\core\Http\Controllers\UserController;

Route::prefix('api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::get('dates', [UserController::class, 'userDatesReadable']);
            Route::get('info', [UserController::class, 'user']);
        
            Route::middleware('admin')->group(function () {
                Route::prefix('admin')->group(function () {
                    Route::post('topCategory/new', [TopCategoryController::class, 'store']);
                    Route::post('category/new', [CategoryController::class, 'store']);
                    Route::post('article/new', [ArticleController::class, 'store']);
                    Route::post('settings/new', [SettingController::class, 'store']);
                    Route::post('home/new', [HomeController::class, 'store']);
                    Route::post('about/new', [AboutController::class, 'store']);
                    Route::post('contact/new', [ContactController::class, 'store']);

                    Route::get('stats/thisMonth', [StatsController::class, 'getStatsForFullMonth']);
                });
            });
        });
    });

    Route::get('topCategory/all', [TopCategoryController::class,'all']);
    Route::get('topCategory/{id}', [TopCategoryController::class, 'view']);

    Route::get('category/all', [CategoryController::class, 'all']);
    Route::get('category/{id}', [CategoryController::class, 'view']);

    Route::get('article/all', [ArticleController::class, 'all']);
    Route::get('article/{id}', [ArticleController::class, 'view']);
});
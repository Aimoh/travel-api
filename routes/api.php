<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\TourController;
use App\Http\Controllers\Api\V1\TravelController;
use App\Http\Controllers\Api\V1\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
//    Route::get('travels', [TravelController::class, 'index']);
//});

//Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
//    Route::get('travels/{travels:slug}/tours', [TourController::class, 'index']);
//});


Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::get('travels', [TravelController::class, 'index']);
    Route::get('travels/{travels:slug}/tours', [TourController::class, 'index']);
});


Route::prefix('v1/admin')
    ->middleware('auth:sanctum')
    ->namespace('App\Http\Controllers\Api\V1')
    ->group(function () {
        Route::middleware('role:admin')->group(function () {
            Route::post('travels', [Admin\TravelController::class, 'store']);
            Route::post('travels/{travel}/tours', [Admin\TourController::class, 'store']);
        });

        Route::put('travels/{travel}', [Admin\TravelController::class, 'update']);
    });

Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::post('login', LoginController::class);
});




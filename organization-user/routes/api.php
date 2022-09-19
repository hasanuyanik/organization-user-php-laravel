<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['throttle:50,1'])->group(function() {
    Route::prefix('/organization')->controller(OrganizationController::class)->group(function() {
        Route::get('list', 'list');
        Route::post('create', 'create');
        Route::post('update/{id}', 'update');
        Route::post('get', 'byDatas');
    });

    Route::prefix('/user')->controller(UserController::class)->group(function() {
        Route::get('list', 'list');
        Route::post('create', 'create');
        Route::post('update/{id}', 'update');
        Route::post('get', 'byDatas');
    });
});
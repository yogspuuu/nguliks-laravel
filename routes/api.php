<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'product'], function () {
    Route::post('create', [ProductController::class, 'create']);
    Route::get('list', [ProductController::class, 'list']);
    Route::get('detail/{product}', [ProductController::class, 'detail']);
    Route::put('update/{product}', [ProductController::class, 'update']);
    Route::delete('delete/{product}', [ProductController::class, 'delete']);
});

Route::group(['prefix' => 'category'], function () {
    Route::post('create', [CategoryController::class, 'create']);
    Route::get('list', [CategoryController::class, 'list']);
    Route::get('detail/{category}', [CategoryController::class, 'detail']);
    Route::put('update/{category}', [CategoryController::class, 'update']);
    Route::delete('delete/{category}', [CategoryController::class, 'delete']);
});

Route::group(['prefix' => 'image'], function () {
    Route::post('create', [ImageController::class, 'create']);
    Route::get('list', [ImageController::class, 'list']);
    Route::get('detail/{image}', [ImageController::class, 'detail']);
    Route::put('update/{image}', [ImageController::class, 'update']);
    Route::delete('delete/{image}', [ImageController::class, 'delete']);
});

<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ProductController;
use App\Models\Product;
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

Route::group(['prefix' => 'product'], function() {
    Route::post('create', [ProductController::class, 'create']);
    Route::get('{product_id}', [ProductController::class, 'read']);
    Route::put('{product_id}', [ProductController::class, 'update']);
    Route::delete('{product_id}', [Product::class, 'delete']);
});

Route::group(['prefix' => 'category'], function() {
    Route::post('{category_id}', [CategoryController::class, 'create']);
    Route::get('{category_id}', [CategoryController::class, 'read']);
    Route::put('{category_id}', [CategoryController::class, 'update']);
    Route::delete('{category_id}', [CategoryController::class, 'delete']);
});

Route::group(['prefix' => 'image'], function() {
    Route::post('{image_id}', [ImageController::class, 'create']);
    Route::get('{image_id}', [ImageController::class, 'read']);
    Route::put('{image_id}', [ImageController::class, 'update']);
    Route::delete('{image_id}', [ImageController::class, 'delete']);
});

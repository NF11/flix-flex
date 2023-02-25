<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\FavoritesController;
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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('contents/top', [ContentsController::class, 'getTopRating']);
    Route::resource('contents', ContentsController::class)->only(['index', 'show']);
    Route::post('contents/{content}/favorites', [FavoritesController::class, 'sync']);
    Route::get('me/favorites', [FavoritesController::class, 'index']);
});

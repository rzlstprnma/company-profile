<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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


Route::post('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'admin'], function () {
    Route::resource('categories', CategoryController::class, [
        'only' => ['index', 'store', 'destroy']
    ]);
    Route::resource('tags', TagController::class, [
        'only' => ['index', 'store', 'destroy']
    ]);
    Route::resource('posts', PostController::class, [
        'only' => ['index', 'store', 'destroy']
    ]);
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController as AdminUsersController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
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

Route::get('/test', [TestController::class, 'anyTest']);

Route::group(['middleware' => 'role:administrator,manager'], function () {
    Route::get('/test/{req}', [TestController::class, 'anyTest']);
});

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['prefix' => 'posts'], function () {
    Route::get('', [PostController::class, 'index']);
    Route::get('{post:slug}', [PostController::class, 'show']);
    Route::post('', [PostController::class, 'store']);
    Route::post('{post}/setLike', [PostController::class, 'setLikeValue']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('', [UserController::class, 'index']);
    Route::get('{user}', [UserController::class, 'show']);
    Route::put('{user}', [UserController::class, 'update']);
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'role:administrator,manager'
], function () {
    Route::prefix('users')->group(function () {
        Route::get('', [AdminUsersController::class, 'getUsers']);
        Route::post('/create', [AdminUsersController::class, 'storeUser']);
        Route::delete('{user}', [AdminUsersController::class, 'destroyUser']);
        Route::get('{user}', [AdminUsersController::class, 'showUser']);
        Route::put('{user}', [AdminUsersController::class, 'updateUser']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('', [AdminPostController::class, 'getPosts']);
        Route::post('create', [AdminPostController::class, 'storePost']);
        Route::delete('{post}', [AdminPostController::class, 'destroyPost']);
        Route::get('{post}', [AdminPostController::class, 'showPost']);
        Route::put('{post}', [AdminPostController::class, 'updatePost']);
    });
});

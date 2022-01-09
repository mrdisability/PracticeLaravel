<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);

Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);

//User has to be authenticated to enter users route
Route::middleware(['auth:api'])->group(function () {
    Route::get('user', [App\Http\Controllers\AuthController::class, 'user']);
    Route::put('users/info', [App\Http\Controllers\AuthController::class, 'updateInfo']);
    Route::put('users/password', [App\Http\Controllers\AuthController::class, 'updatePassword']);
    
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
});

//Todos, dont need authentication 
Route::apiResource('todos', \App\Http\Controllers\TodoController::class);

//Route::get('users', [UserController::class, 'index']);
//Route::get('users/{id}', [UserController::class, 'show']);
//Route::post('users', [UserController::class, 'store']);
//Route::put('users/{id}', [UserController::class, 'update']);
//Route::delete('users/{id}', [UserController::class, 'destroy']);

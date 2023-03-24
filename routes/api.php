<?php

use App\Http\Controllers\Api\UsersController;
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

Route::get('users', [UsersController::class, 'get']);
Route::get('users/{id}', [UsersController::class, 'getById']);
Route::post('users', [UsersController::class, 'add']);
Route::put('users/{id}/update', [UsersController::class, 'update']);
Route::delete('users/{id}/delete', [UsersController::class, 'delete']);
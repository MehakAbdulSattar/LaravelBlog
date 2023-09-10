<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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

Route::prefix('post')->middleware('auth:api')->group(function () {
    Route::get('/all', 'App\Http\Controllers\API\PostController@index');
    Route::post('/store', 'App\Http\Controllers\API\PostController@store');
    Route::put('/{post}', 'App\Http\Controllers\API\PostController@update');
    Route::delete('/{post}', 'App\Http\Controllers\API\PostController@destroy');
});


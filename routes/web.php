<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GuestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');



//set route to get view page of admin
//Add Middleware 
//call middleware function and inside is array auth
//auth is builtin function in laravel for authentication
Route::prefix('admin')->middleware(['isAdmin'])->group (function()
{
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class,'index'])->middleware('isAdmin');
    //Route::get('posts',[App\Http\Controllers\Auth\AdminPostController]);

});

Route::prefix('post')->middleware(['auth'])->group (function()
{
    Route::get('/create', [App\Http\Controllers\PostController::class,'create'])->name('post.create');
    //Route::get('posts',[App\Http\Controllers\Auth\AdminPostController]);

    Route::post('/store', 'App\Http\Controllers\PostController@store')->name('post.store');

    Route::get('/all', 'App\Http\Controllers\PostController@index')->name('post.index');
    
   

    // Correct route definition
    //Route::get('/post', [PostController::class, 'index']);

    // Incorrect route definition (use correct namespace and method name)
    //Route::get('/post', [Post::class, 'index']);

    // Routes for deleting posts
    Route::delete('{post}', 'App\Http\Controllers\PostController@destroy')->name('post.destroy');

    // Routes for deleting comments
    Route::delete('/comments/{comment}', 'App\Http\Controllers\CommentController@destroy')->name('comments.destroy');



});
Route::get('post/edit/{post}', 'App\Http\Controllers\PostController@edit')->name('post.edit');
Route::put('post/update/{post}', 'App\Http\Controllers\PostController@update')->name('post.update');
Route::post('/comments', 'App\Http\Controllers\CommentController@store')->name('comments.store');



<?php

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
// Public routes
Route::post('/register', [\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class,'login'])->name('login');
//Route::get('/logout', [\App\Http\Controllers\AuthController::class,'logout']);


// Protected routes
Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::get('posts', [\App\Http\Controllers\PostsController::class,'index'])->name('posts.index');
    Route::post('posts/create', [\App\Http\Controllers\PostsController::class,'store'])->name('posts.store');
    Route::put('posts/{id}', [\App\Http\Controllers\PostsController::class,'update'])->name('posts.update');
    Route::get('posts/{id}', [\App\Http\Controllers\PostsController::class,'show'])->name('posts.show');
    Route::delete('posts/{id}', [\App\Http\Controllers\PostsController::class,'destroy'])->name('posts.destroy');
    Route::post('/logout', [\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
});

<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::resource('/articles', ArticleController::class)->except(['index', 'show'])->middleware('auth');
Route::resource('/articles',  ArticleController::class)->only(['show']);
Route::get('/articles/{name}/following', [ArticleController::class, 'following'])->name('articles.following')->middleware('auth');

Route::prefix('users')->name('users.')->group( function (){
    Route::get('/{name}', [UserController::class, 'show'])->name('show');
});
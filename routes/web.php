<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/following', [ArticleController::class, 'following'])->name('articles.following')->middleware('auth');
Route::get('/bookmarks', [ArticleController::class, 'bookmarks'])->name('articles.bookmarks')->middleware('auth');
Route::get('/cards', [CardController::class, 'index'])->name('cards.index')->middleware('auth');
Route::resource('/articles', ArticleController::class)->except(['index', 'show'])->middleware('auth');
Route::resource('/articles',  ArticleController::class)->only(['show']);
Route::prefix('/articles')->name('articles.')->group(function() {
    Route::put('/{article}/like', [ArticleController::class, 'like'])->name('like')->middleware('auth');
    Route::delete('/{article}/like', [ArticleController::class, 'unlike'])->name('unlike')->middleware('auth');
    Route::put('/{article}/bookmark', [ArticleController::class, 'bookmark'])->name('bookmark')->middleware('auth');
    Route::delete('/{article}/bookmark', [ArticleController::class, 'unBookmark'])->name('unBookmark')->middleware('auth');
});

Route::prefix('users')->name('users.')->group( function (){
    Route::get('/{name}', [UserController::class, 'show'])->name('show');
    Route::get('/{name}/likes', [UserController::class, 'likes'])->name('likes');
    Route::get('/{name}/followings', [UserController::class, 'followings'])->name('followings');
    Route::get('/{name}/followers', [UserController::class, 'followers'])->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', [UserController::class, 'follow'])->name('follow');
        Route::delete('/{name}/follow', [UserController::class, 'unfollow'])->name('unfollow');
    });
});

Route::prefix('rankings')->name('rankings.')->group(function() {
    Route::get('/', [RankingController::class, 'article'])->name('article');
    Route::get('/article', [RankingController::class, 'article'])->name('article');
    Route::get('/follower', [RankingController::class, 'follower'])->name('follower');
    Route::get('/like', [RankingController::class, 'like'])->name('like');
});

Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show');
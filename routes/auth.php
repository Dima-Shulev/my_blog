<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ArticleController;
use App\Http\Controllers\Auth\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RoomController;
use App\Http\Controllers\Auth\ReviewsController;

//work in personal account
Route::prefix('auth')->middleware('auth')->middleware('active')->middleware('verified')->group(function(){
    Route::redirect('/','auth/room')->name('user');
    Route::get('/room', [RoomController::class, 'index'])->name('auth.room');
    Route::get('/room/{id}/edit',[RoomController::class,'editUser'])->name('auth.room.editUser');
    Route::post('/room/{id}/edit', [RoomController::class,'update'])->name('auth.room.update');
    Route::get('/room/balance', [RoomController::class, 'balance'])->name('auth.room.balance');

    Route::post('/room',[RoomController::class, 'closeSession'])->name('auth.room.close')->withoutMiddleware('auth');

    Route::get('/category', [CategoryController::class, 'index'])->name('auth.categories');
    Route::get('/category/{name}', [CategoryController::class, 'show'])->name('auth.categories.show');

    Route::get('/article', [ArticleController::class, 'index'])->name('auth.article');
    Route::get('/article/{url}', [ArticleController::class, 'show'])->name('auth.articles.show');

    Route::get('/reviews',[ReviewsController::class,'index'])->name('auth.reviews');
    Route::get('/reviews/create',[ReviewsController::class,'create'])->name('auth.reviews.create');
    Route::post('/reviews',[ReviewsController::class,'store'])->name('auth.reviews.store');
    Route::get('/reviews/{post}',[ReviewsController::class,'show'])->name('auth.reviews.show');
    Route::post('/reviews/{post}',[ReviewsController::class, 'like'])->name('auth.reviews.like');
});

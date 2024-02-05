<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ImageTaskController;

Route::redirect('/','/page');
Route::prefix('page')->group(function(){
    Route::get('/',[PageController::class,'index'])->name('home');
    Route::get('/{url}',[PageController::class,'show'])->name('show');
});

Route::view('/charts','charts')->name('charts');

Route::get('/ajax', [SelectController::class, 'currencyAndValue']);
Route::post('/ajaxValueCandle', [SelectController::class, 'showCandle']);

Route::get('/email/verify', function () {
    return view('auth.room.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home')->with('success','success_verify_email');
})->middleware(['auth','signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');

Route::post('/upload/post-image', [ImageTaskController::class,'uploadImage'])->name('upload.post.image');

Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LogController::class, 'index'])->name('login');
    Route::post('/login', [LogController::class, 'store'])->name('login.store');
    Route::get('/login/forget', [LogController::class, 'forget'])->name('login.forget');
    Route::post('/login/forget', [LogController::class, 'checkMail'])->name('login.checkMail');
    Route::get('/login/check', [LogController::class, 'check'])->name('login.check');
    Route::post('/login/check', [LogController::class, 'checkCode'])->name('login.check-code');
    Route::get('/login/change/{id}', [LogController::class, 'change'])->name('login.change');
    Route::post('/login/change', [LogController::class, 'changePass'])->name('login.changePass');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/{name}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/article', [ArticleController::class, 'index'])->name('article');
    Route::get('/article/{url}', [ArticleController::class, 'show'])->name('articles.show');

    Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews');
    Route::get('/reviews/{post}', [ReviewsController::class, 'show'])->name('reviews.show');
    Route::post('/reviews/{post}', [ReviewsController::class, 'like'])->name('reviews.like');
});

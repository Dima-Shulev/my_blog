<?php

use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;

//work in admin panel
Route::prefix('admin')->middleware('adminPanel')->group(function () {

    Route::get('/',[RoomController::class,'admin'])->name('admin')->withoutMiddleware('adminPanel');
    Route::post('/',[RoomController::class,'entrance'])->name('admin.entrance')->withoutMiddleware('adminPanel');
    Route::get('/room',[RoomController::class,'index'])->name('admin.room');
    Route::get('/room/close',[RoomController::class, 'closeSession'])->name('admin.room.close');

    Route::prefix('reviews')->group(function() {
        Route::controller(ReviewsController::class)->group(function () {
            Route::get('/', 'index')->name('admin.reviews');
            Route::get('/{id}/editor', 'edit')->name('admin.reviews.editor');
            Route::post('/{id}', 'update')->name('admin.reviews.update');
            Route::get('/{id}/active/{active}', 'publicReviews')->name('admin.reviews.publicReview');
            Route::get('/{id}/deleteReviews', 'deleteReviews')->name('admin.reviews.deleteReviews');
        });
    });

    Route::prefix('users')->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('/','index')->name('admin.users');
            Route::get('/{id}/active/{active}','publicUser')->name('admin.users.publicUser');
            Route::get('/{id}/edit','edit')->name('admin.users.edit');
            Route::post('/{id}/edit','update')->name('admin.users.update');
            Route::get('/{id}','delete')->name('admin.users.delete');
        });
    });

    Route::prefix('categories')->group(function() {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('admin.categories');
            Route::get('/create', 'create')->name('admin.categories.create');
            Route::post('/', 'store')->name('admin.categories.store');
            Route::get('/{url}/edit', 'edit')->name('admin.categories.edit');
            Route::post('/{id}', 'update')->name('admin.categories.update');
            Route::get('/{id}/active/{active}', 'publicCategory')->name('admin.categories.publicCategory');
            Route::get('/{id}/deleteCategory', 'deleteCategory')->name('admin.categories.delete');
        });
    });

    Route::prefix('articles')->group(function() {
        Route::controller(ArticleController::class)->group(function(){
            Route::get('/','index')->name('admin.articles');
            Route::get('/create','create')->name('admin.articles.create');
            Route::post('/','store')->name('admin.articles.store');
            Route::get('/{url}/edit','edit')->name('admin.articles.edit');
            Route::post('/{id}','update')->name('admin.articles.update');
            Route::get('/{id}/active/{active}','publicArticle')->name('admin.articles.publicArticle');
            Route::get('/{id}/deleteArticle','deleteArticle')->name('admin.articles.delete');
        });
    });

    Route::prefix('pages')->group(function() {
        Route::controller(PageController::class)->group(function(){
            Route::get('/','index')->name('admin.pages');
            Route::get('/create','create')->name('admin.pages.create');
            Route::post('/','store')->name('admin.pages.store');
            Route::get('/{url}/edit','edit')->name('admin.pages.edit');
            Route::post('/{id}','update')->name('admin.pages.update');
            Route::get('/{id}/active/{active}','publicPage')->name('admin.pages.publicPage');
            Route::get('/{id}/deletePage','deletePage')->name('admin.pages.delete');
        });
    });

    Route::get('/template',[TemplateController::class,'index'])->name('admin.templates');
    Route::get('/template/{id}/{active}',[TemplateController::class, 'publicTemplate'])->name('admin.templates.publicTemplate');

    Route::get('/modules',[ModuleController::class,'index'])->name('admin.modules');
    Route::get('/modules/{id}/{active}',[ModuleController::class, 'publicModules'])->name('admin.modules.publicModules');
});

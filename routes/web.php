<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front;
use App\Http\Controllers\Back;

//Backend Routes
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
    Route::get('giris', [Back\AuthController::class, 'login'])->name('login');
    Route::post('giris', [Back\AuthController::class, 'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel', [Back\Dashboard::class, 'index'])->name('dashboard');
    Route::get('makaleler/silinenler', [Back\ArticleController::class, 'trashed'])->name('trashed.post');

    Route::resource('makaleler', Back\ArticleController::class);
    Route::get('/switch', [Back\ArticleController::class, 'switch'])->name('status');
    Route::get('/kategori/status', [Back\CategoryController::class, 'switch'])->name('category.switch');
    Route::get('/deletepost{id}', [Back\ArticleController::class, 'delete'])->name('delete.post');
    Route::get('/harddeletepost{id}', [Back\ArticleController::class, 'hardDelete'])->name('hard.delete.post');
    Route::get('/recoverpost{id}', [Back\ArticleController::class, 'recover'])->name('recover.post');
    Route::get('cikis', [Back\AuthController::class, 'logout'])->name('logout');
    Route::get('/kategoriler', [Back\CategoryController::class, 'index'])->name('category.index');

});


// Front Routes

Route::get('/', [Front\Homepage::class, 'index'])->name('index');
Route::get('/kategori/{category}', [Front\Homepage::class, 'category'])->name('category');
Route::get('/post/{slug}', [Front\Homepage::class, 'posts'])->name('post');
Route::post('/contact' , [Front\Homepage::class, 'contactpost'])->name('contact.post');
Route::get('/contact' , [Front\Homepage::class, 'contact'])->name('contact');
Route::get('/{sayfa}', [Front\Homepage::class, 'page'])->name('page');
Route::post('/kategori/create', [Back\CategoryController::class, 'create'])->name('category.create');




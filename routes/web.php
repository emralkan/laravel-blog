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
    Route::get('/switch', [Back\ArticleController::class, 'switch'])->name('switch');
    Route::get('/kategori/status', [Back\CategoryController::class, 'switch'])->name('category.switch');
    Route::get('/kategori/getdata', [Back\CategoryController::class, 'getdata'])->name('category.getdata');
    Route::post('/kategori/update', [Back\CategoryController::class, 'update'])->name('category.update');
    Route::post('/kategori/delete', [Back\CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/deletepost{id}', [Back\ArticleController::class, 'delete'])->name('delete.post');
    Route::get('/harddeletepost{id}', [Back\ArticleController::class, 'hardDelete'])->name('hard.delete.post');
    Route::get('/recoverpost{id}', [Back\ArticleController::class, 'recover'])->name('recover.post');
    Route::get('cikis', [Back\AuthController::class, 'logout'])->name('logout');
    Route::get('/kategoriler', [Back\CategoryController::class, 'index'])->name('category.index');
    //Page Routes
    Route::get('sayfalar', [Back\PageController::class, 'index'])->name('page.index');
    Route::get('sayfa/olustur', [Back\PageController::class, 'create'])->name('page.create');
    Route::get('sayfa/duzenle/{id}', [Back\PageController::class, 'update'])->name('page.edit');
    Route::post('sayfa/duzenle/{id}', [Back\PageController::class, 'updatePost'])->name('page.edit.post');
    Route::post('sayfa/olustur', [Back\PageController::class, 'post'])->name('page.create.post');
    Route::get('/sayfa/sil/{id}', [Back\PageController::class, 'pageDelete'])->name('page.delete');
    Route::get('/sayfa/switch', [Back\PageController::class, 'switch'])->name('page.switch');
    Route::get('/sayfa/siralama', [Back\PageController::class, 'orders'])->name('page.orders');

});



// Front Routes

Route::get('/', [Front\Homepage::class, 'index'])->name('index');
Route::get('/kategori/{category}', [Front\Homepage::class, 'category'])->name('category');
Route::get('/post/{slug}', [Front\Homepage::class, 'posts'])->name('post');
Route::post('/contact' , [Front\Homepage::class, 'contactpost'])->name('contact.post');
Route::get('/contact' , [Front\Homepage::class, 'contact'])->name('contact');
Route::get('/{sayfa}', [Front\Homepage::class, 'page'])->name('page');
Route::post('/kategori/create', [Back\CategoryController::class, 'create'])->name('category.create');

//Mail Routes






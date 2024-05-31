<?php

use Illuminate\Support\Facades\Route;

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
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/produits', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/produits/{slug}-{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show')->where([
    'product' => $idRegex,
    'slug' => $slugRegex
]);
Route::post('/produits/{product}/contact', [\App\Http\Controllers\ProductController::class, 'contact'])->name('product.contact')->where([
    'product' => $idRegex,
]);

Route::post('/cart/add/{productId}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/remove/{itemId}', [\App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');


Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/images/{path}', [\App\Http\Controllers\ImageController::class, 'show'])->where('path', '.*');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () use ($idRegex) {
   Route::resource('product', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
   Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);
   Route::delete('picture/{picture}', [\App\Http\Controllers\Admin\PictureController::class, 'destroy'])
       ->name('picture.destroy')
       ->where([
           'picture' => $idRegex,
       ]);
});

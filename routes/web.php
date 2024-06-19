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



Route::middleware(['auth','admin'])->group(function () {

// Affiche la liste de tous les utilisateurs
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

// Montre un formulaire pour créer un nouvel utilisateur
Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');

// Montre un formulaire d'édition pour un utilisateur existant
Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');

// Supprime un utilisateur
Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

});
// Enregistre un nouvel utilisateur
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');



// Affiche un utilisateur spécifique
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');

// Met à jour un utilisateur
Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update']);


Route::middleware(['auth'])->group(function () {
    Route::get('/myaccount', [\App\Http\Controllers\UserController::class, 'editmyaccount'])->name('users.myaccount');
    Route::put('/myaccount', [\App\Http\Controllers\UserController::class, 'updatemyaccount'])->name('users.updateMyAccount');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('addresses', \App\Http\Controllers\AddressController::class);
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/produits', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/produits/{slug}-{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show')->where([
    'product' => $idRegex,
    'slug' => $slugRegex
]);
Route::post('/produits/{product}/contact', [\App\Http\Controllers\ProductController::class, 'contact'])->name('product.contact')->where([
    'product' => $idRegex,
]);
Route::middleware(['auth'])->group(function () {
Route::post('/cart/add/{productId}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/remove/{itemId}', [\App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/orders/{order}/confirm', [\App\Http\Controllers\OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'list'])->name('orders.myorders');
});



Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/images/{path}', [\App\Http\Controllers\ImageController::class, 'show'])->where('path', '.*');

Route::prefix('admin')->name('admin.')->middleware('auth','admin')->group(function () use ($idRegex) {
   Route::resource('product', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
   Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);
   Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
   Route::delete('picture/{picture}', [\App\Http\Controllers\Admin\PictureController::class, 'destroy'])
       ->name('picture.destroy')
       ->where([
           'picture' => $idRegex,
       ]);
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}/edit', [\App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('orders.edit');
    Route::put('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');

});

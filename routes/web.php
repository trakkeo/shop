<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OptionController as AdminOptionController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PictureController as AdminPictureController;

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

Route::middleware(['auth', 'admin'])->group(function () {

    // Affiche la liste de tous les utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Montre un formulaire pour créer un nouvel utilisateur
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // Montre un formulaire d'édition pour un utilisateur existant
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Supprime un utilisateur
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
// Enregistre un nouvel utilisateur
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Affiche un utilisateur spécifique
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// Met à jour un utilisateur
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::patch('/users/{user}', [UserController::class, 'update']);

Route::middleware(['auth'])->group(function () {
    Route::get('/myaccount', [UserController::class, 'editmyaccount'])->name('users.myaccount');
    Route::put('/myaccount', [UserController::class, 'updatemyaccount'])->name('users.updateMyAccount');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('addresses', AddressController::class);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/produits', [ProductController::class, 'index'])->name('product.index');
Route::get('/produits/{slug}-{product}', [ProductController::class, 'show'])->name('product.show')->where([
    'product' => $idRegex,
    'slug' => $slugRegex
]);
Route::post('/produits/{product}/contact', [ProductController::class, 'contact'])->name('product.contact')->where([
    'product' => $idRegex,
]);
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/remove/{itemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/orders/{order}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'list'])->name('orders.myorders');
});

Route::get('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/images/{path}', [ImageController::class, 'show'])->where('path', '.*');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::prefix('admin')->name('admin.')->middleware('auth', 'admin')->group(function () use ($idRegex) {
    Route::resource('product', AdminProductController::class)->except(['show']);
    Route::resource('option', AdminOptionController::class)->except(['show']);
    Route::resource('orders', AdminOrderController::class);
    Route::delete('picture/{picture}', [AdminPictureController::class, 'destroy'])
        ->name('picture.destroy')
        ->where([
            'picture' => $idRegex,
        ]);
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
    Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
});

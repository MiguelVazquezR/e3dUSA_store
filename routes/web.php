<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationEmailController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $discount_products = Product::latest()->whereNotNull('discount')->get()->take(5);
        // return $discount_products;
        return Inertia::render('Dashboard', compact('discount_products'));
    })->name('dashboard');
});

Route::resource('products', ProductController::class);
Route::get('/products-index-admin', [ProductController::class, 'indexAdmin'])->name('products.indexAdmin'); //agregar un middelware de admin


Route::resource('carts', CartController::class);
Route::get('/payment-verification', [CartController::class, 'paymentVerification'])->name('carts.payment-verification');


Route::resource('cart-products', CartProductController::class);


Route::resource('sales', SaleController::class);


Route::resource('addresses', AddressController::class);


Route::resource('invoices', InvoiceController::class);


Route::resource('payment-methods', PaymentMethodController::class);


Route::resource('notification-emails', NotificationEmailController::class);



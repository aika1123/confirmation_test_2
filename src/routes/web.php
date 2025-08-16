<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::get('/products/register',  [ContactController::class, 'create'])->name('products.create');

Route::post('/products/register', [ContactController::class, 'store'])->name('products.store');

Route::get('/products', [ContactController::class, 'index'])->name('products.list');

Route::get('/products/{productId}', [ContactController::class, 'show'])->name('products.show');

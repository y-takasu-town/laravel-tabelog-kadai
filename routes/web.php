<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ReviewController;


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
    return view('welcome');
});

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/', [TopController::class, 'index']);
Route::post('stores/{store}/favorite', [StoreController::class, 'favorite'])->name('stores.favorite');
Route::resource('stores', StoreController::class)->middleware(['auth', 'verified']);
// Auth::routes(['verify' => true]);
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

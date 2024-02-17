<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SubscriptionController;


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

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');  
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');

});

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/', [TopController::class, 'index']);

Route::post('stores/{store}/favorite', [StoreController::class, 'favorite'])->name('stores.favorite');
Route::resource('stores', StoreController::class)->middleware(['auth', 'verified']);

Route::get('company', [CompanyController::class,'index'])->name('company');

Route::get('stores/{store}/reservation', [App\Http\Controllers\ReservationController::class, 'create'])->name('stores.reservation');
Route::post('stores/{store}/reservation', [App\Http\Controllers\ReservationController::class, 'store'])->name('stores.reservation.save');
// Auth::routes(['verify' => true]);
Auth::routes();
Route::post('mypage', [ReservationController::class, 'destroy'])->name('reservations.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription')->middleware('auth');
Route::post('/subscription/payment', [SubscriptionController::class, 'store'])->name('stripe.store')->middleware('auth');
Route::post('/subscription/cancel/', [SubscriptionController::class,'cancelsubscription'])->name('stripe.cancel');
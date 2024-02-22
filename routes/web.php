<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\HomeController;


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

Route::get('/', [TopController::class, 'index']);
    
Route::get('company', [CompanyController::class,'index'])->name('company');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('users/mypage', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
        Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
        Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');  
        Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    
    });
    
    Route::controller(StoreController::class)->group(function () {
        Route::post('stores/{store}/favorite', 'favorite')->name('stores.favorite');
    
    });   

    Route::resource('stores', StoreController::class)->middleware(['auth', 'verified']);

    Route::controller(ReservationController::class)->group(function () {
        Route::get('stores/{store}/reservation', 'create')->name('stores.reservation');
        Route::post('stores/{store}/reservation', 'store')->name('stores.reservation.save');
        Route::delete('reservation/{reservation}/delete', 'destroy')->name('reservations.destroy');
    
    });
    
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('/subscription', 'index')->name('subscription')->middleware('auth');
        Route::post('/subscription/payment', 'store')->name('stripe.store')->middleware('auth');
        Route::post('/subscription/cancel/', 'cancelsubscription')->name('stripe.cancel');
        Route::get('/edit_card', 'edit')->name('mypage.edit_card')->middleware('auth');
        Route::post('/update_card', 'update')->name('stripe.update')->middleware('auth');
    
    });
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
        
});

Auth::routes(['verify' => true]);

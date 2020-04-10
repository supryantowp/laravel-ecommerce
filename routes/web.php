<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

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


Route::get('/', 'LandingPageController@index')->name('landing-page');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::post('/cart/swithToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSafeForLater');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');
Route::delete('/saveForLatter/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');

Route::post('/coupon', 'CouponController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponController@destroy')->name('coupon.destroy');

Route::get('/checkout', 'CheckOutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckOutController@store')->name('checkout.store');

Route::get('/thankyou', 'ConfirmationController@index')->name('confiramtion.index');


Route::get('/empty', function () {
    Cart::instance('saveForLater')->destroy();
});

<?php

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify/email/{token}', 'Auth\AuthController@verifyEmail');
// Product
Route::prefix('product')->namespace('Front')->group(function () {
    Route::name('product.display')->get('{slug}', 'ProductController@show');
    Route::name('product.search')->get('', 'ProductController@search');
});
Route::get('/category/{category}', 'Front\ProductController@category')->name('category');

Route::get('/cart', 'Front\CartController@cart')->name('cart');
Route::get('/add-to-cart/{id}', 'Front\CartController@addToCart');
Route::patch('update-cart', 'Front\CartController@update');
Route::delete('remove-from-cart', 'Front\CartController@remove');
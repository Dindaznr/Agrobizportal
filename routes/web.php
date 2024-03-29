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
Route::get('/register/seller', function () {
    return view('auth.register-seller');
});
Route::name('register.seller')->post('/register/seller', 'Auth\RegisterController@registerSeller');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify/email/{token}', 'Auth\AuthController@verifyEmail');
Route::namespace('Front')->group(function () {
    // Product
    Route::prefix('product')->group(function () {
        Route::name('product.display')->get('{slug}', 'ProductController@show');
        Route::name('product.search')->get('', 'ProductController@search');
    });
    Route::get('/category/{category}', 'ProductController@category')->name('category');
    
    Route::middleware('auth')->group(function () {
        Route::get('/cart', 'CartController@cart')->name('cart');
        Route::get('/cart/checkout', 'CartController@checkout')->name('checkout');
        Route::get('/add-to-cart/{id}', 'CartController@addToCart');
        Route::patch('update-cart', 'CartController@update');
        Route::delete('remove-from-cart', 'CartController@remove');
    
        // Order
        Route::name('order.store')->post('order/store', 'OrderController@store');
    
        // People
        Route::prefix('people')->middleware('customer')->group(function () {
            Route::name('people.index')->get('', 'ProfileController@index');
            Route::name('people.order')->get('order', 'OrderController@index');
            Route::get('address', 'ProfileController@address');
            Route::post('address', 'ProfileController@submitAddress');
            Route::patch('order/update', 'OrderController@update');
        });
    });
});


Route::prefix('admin')->namespace('Back')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::name('dashboard')->get('/', 'DashboardController@index');
    
        Route::resource('orders', 'OrderController');
        Route::patch('orders/update', 'OrderController@update');
        Route::get('payment', 'OrderController@payment')->name('orders.payment');
        
        Route::middleware('seller')->group(function () {
            Route::resource('products', 'ProductController');
            Route::resource('categories', 'CategoryController');
            
            // Route::resource('reports', 'CategoryController');
            Route::name('reports.sales')->get('/reports/sales', 'ReportController@sales');
            Route::name('reports.sales.export')->get('/reports/sales/export', 'ReportController@exportSales');
            
            Route::name('reports.income')->get('/reports/income', 'ReportController@income');
            Route::name('reports.income.export')->get('/reports/income/export', 'ReportController@exportIncome');

            Route::name('reports.delivery')->get('/reports/delivery', 'ReportController@delivery');
            Route::name('reports.delivery.search')->get('/reports/delivery/search', 'ReportController@delivery');
            Route::name('reports.delivery.export')->get('/reports/delivery/export', 'ReportController@exportDelivery');
        });

        Route::middleware('admin')->group(function () {
            Route::resource('customers', 'CustomerController');
        });
    });
});
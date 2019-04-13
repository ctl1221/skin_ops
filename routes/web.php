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

Route::get('/', function () {
    
    $pricelist = App\PricelistSellable::with('sellable')->get();

    return $pricelist;


});

//Master Data
Route::resource('pricelists', 'PricelistController');

Route::resource('clients', 'ClientController');

Route::resource('products', 'ProductController');
Route::post('/products/{product}/deactivate', 'ProductController@deactivate');
Route::post('/products/{product}/activate', 'ProductController@activate');

//Transactional Data
Route::get('/sales_orders', 'SalesOrderController@index');
Route::get('/sales_orders/create/client/{client}', 'SalesOrderController@create');
Route::post('/sales_orders', 'SalesOrderController@store');
Route::delete('/sales_orders/{sales_order}', 'SalesOrderController@destroy');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

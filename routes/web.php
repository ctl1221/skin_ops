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
Route::resource('clients', 'ClientController');
Route::resource('products', 'ProductController');
Route::resource('services', 'ServiceController');
Route::resource('packages', 'PackageController');
Route::resource('employees', 'EmployeeController');

Route::get('/branches','BranchController@index');
Route::get('/branches/create','BranchController@create');
Route::post('/branches','BranchController@store');
Route::get('/branches/edit','BranchController@edit');
Route::post('/branches/update','BranchController@update');

Route::get('/pricelists','PricelistController@index');
Route::get('/pricelists/create','PricelistController@create');
Route::post('/pricelists','PricelistController@store');
Route::get('/pricelists/edit','PricelistController@edit');
Route::post('/pricelists/update','PricelistController@update');

Route::get('/payment_types','PaymentTypeController@index');
Route::get('/payment_types/create','PaymentTypeController@create');
Route::post('/payment_types','PaymentTypeController@store');
Route::get('/payment_types/edit','PaymentTypeController@edit');
Route::post('/payment_types/update','PaymentTypeController@update');

Route::get('/memberships','MembershipController@index');
Route::get('/memberships/create','MembershipController@create');
Route::post('/memberships','MembershipController@store');
Route::get('/memberships/edit','MembershipController@edit');
Route::post('/memberships/update','MembershipController@update');

//Modify
Route::get('/products/{product}/deactivate', 'ProductController@deactivate');
Route::get('/products/{product}/activate', 'ProductController@activate');

Route::get('/services/{service}/deactivate', 'ServiceController@deactivate');
Route::get('/services/{service}/activate', 'ServiceController@activate');

Route::get('/packages/{package}/deactivate', 'PackageController@deactivate');
Route::get('/packages/{package}/activate', 'PackageController@activate');

Route::post('/branches/{branch}/deactivate', 'BranchController@deactivate');
Route::post('/branches/{branch}/activate', 'BranchController@activate');

Route::get('/employees/{employee}/deactivate', 'EmployeeController@deactivate');
Route::get('/employees/{employee}/activate', 'EmployeeController@activate');

Route::get('/clients/{client}/deactivate', 'ClientController@deactivate');
Route::get('/clients/{client}/activate', 'ClientController@activate');

Route::get('/pricelists/{pricelist}/deactivate', 'PricelistController@deactivate');
Route::get('/pricelists/{pricelist}/activate', 'PricelistController@activate');

Route::post('/payment_types/{paymentType}/deactivate', 'PaymentTypeController@deactivate');
Route::post('/payment_types/{paymentType}/activate', 'PaymentTypeController@activate');

Route::post('/memberships/{membership}/deactivate', 'MembershipController@deactivate');
Route::post('/memberships/{membership}/activate', 'MembershipController@activate');

//Transactional Data
Route::get('/sales_orders', 'SalesOrderController@index');
Route::get('/sales_orders/create/client/{client}', 'SalesOrderController@create');
Route::get('/sales_orders/{sales_order}', 'SalesOrderController@show');
Route::post('/sales_orders', 'SalesOrderController@store');
Route::delete('/sales_orders/{sales_order}', 'SalesOrderController@destroy');

//Management
Route::get('/sms_promotions/create/', 'SMSPromotionController@create');
Route::get('/reports/create/', 'ReportController@create');

//APIs
Route::get('/api/services', 'APIController@services');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

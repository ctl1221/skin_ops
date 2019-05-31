<?php

Route::get('/', function(){
    return redirect('/dashboard');
});

Route::get('/dashboard', function(){
	return view('dashboard');
})->middleware('auth');

//Master Data
Route::get('/clients/search', 'ClientController@search');
Route::resource('clients', 'ClientController');
Route::resource('products', 'ProductController');
Route::resource('services', 'ServiceController');
Route::resource('packages', 'PackageController');
Route::resource('employees', 'EmployeeController');
Route::resource('bugs', 'BugController');

Route::resource('users', 'UserController');

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

Route::get('/clients/{client}/claim', 'ClientController@claim');
Route::post('/clients/{client}/claim', 'ClientController@claimPost');
Route::get('/clients/{client}/deactivate', 'ClientController@deactivate');
Route::get('/clients/{client}/activate', 'ClientController@activate');

Route::get('/pricelists/{pricelist}/deactivate', 'PricelistController@deactivate');
Route::get('/pricelists/{pricelist}/activate', 'PricelistController@activate');

Route::post('/payment_types/{paymentType}/deactivate', 'PaymentTypeController@deactivate');
Route::post('/payment_types/{paymentType}/activate', 'PaymentTypeController@activate');

Route::post('/memberships/{membership}/deactivate', 'MembershipController@deactivate');
Route::post('/memberships/{membership}/activate', 'MembershipController@activate');

Route::get('/bugs/{bug}/close', 'BugController@close');
Route::get('/bugs/{bug}/open', 'BugController@open');
Route::get('/bugs/{bug}/delete', 'BugController@delete');

//Transactional Data
Route::get('/sales_orders', 'SalesOrderController@index');
Route::get('/sales_orders/create/client/{client}', 'SalesOrderController@create');
Route::get('/sales_orders/{sales_order}', 'SalesOrderController@show');
Route::post('/sales_orders', 'SalesOrderController@store');
Route::post('/sales_orders/{sales_order}/post', 'SalesOrderController@post');
Route::post('/sales_orders/{sales_order}/delete', 'SalesOrderController@destroy');

Route::get('/payments/create/client/{client}', 'PaymentController@create');
Route::post('/payments', 'PaymentController@store');

//Management
Route::get('/sms_promotions/create/', 'SMSPromotionController@create');
Route::post('/sms_promotions', 'SMSPromotionController@store');
Route::get('/reports/create/', 'ReportController@create');

Route::get('/reports', 'ReportController@index');
Route::post('/reports/download', 'ReportController@download');

//APIs
Route::get('/api/services', 'APIController@services');
Route::get('/api/products', 'APIController@products');
Route::get('/api/packages', 'APIController@packages');
Route::get('/api/employees', 'APIController@employees');
Route::get('/api/clients', 'APIController@clients');

Route::get('/api/sales_orders', 'APIController@sales_orders');
Route::post('/api/clients/search', 'APIController@client_search');
Route::post('/api/appointments', 'APIController@appointments');

Route::get('/appointments', 'AppointmentController@index');
Route::post('/appointments', 'AppointmentController@store');
Route::post('/appointments/{appointment}/edit', 'AppointmentController@edit');
Route::post('/appointments/{appointment}/delete', 'AppointmentController@delete');


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

<?php

Route::get('/','UserController@home');
Route::get('/dashboard','UserController@dashboard');
Route::get('/settings','UserController@settings');
Route::post('/settings','UserController@postSettings');
Route::post('/userpass','UserController@updatePassword');
Route::post('/userroles','UserController@updateRoles');

//Master Data
Route::get('/clients/search', 'ClientController@search');

// Route::resource('clients', 'ClientController');
Route::get('/clients','ClientController@index');
Route::get('/clients/create','ClientController@create');
Route::post('/clients','ClientController@store');
Route::get('/clients/{client}','ClientController@show');
Route::get('/clients/{client}/edit','ClientController@edit');
Route::patch('/clients/{client}','ClientController@update');

// Route::resource('products', 'ProductController');
Route::get('/products','ProductController@index');
Route::get('/products/create','ProductController@create');
Route::post('/products','ProductController@store');
Route::get('/products/{product}','ProductController@show');
Route::get('/products/{product}/edit','ProductController@edit');
Route::patch('/products/{product}','ProductController@update');

// Route::resource('services', 'ServiceController');
Route::get('/services','ServiceController@index');
Route::get('/services/create','ServiceController@create');
Route::post('/services','ServiceController@store');
Route::get('/services/{service}','ServiceController@show');
Route::get('/services/{service}/edit','ServiceController@edit');
Route::patch('/services/{service}','ServiceController@update');

// Route::resource('packages', 'PackageController');
Route::get('/packages','PackageController@index');
Route::get('/packages/create','PackageController@create');
Route::post('/packages','PackageController@store');
Route::get('/packages/{package}','PackageController@show');
Route::get('/packages/{package}/edit','PackageController@edit');
Route::patch('/packages/{package}','PackageController@update');

// Route::resource('employees', 'EmployeeController');
Route::get('/employees','EmployeeController@index');
Route::get('/employees/create','EmployeeController@create');
Route::post('/employees','EmployeeController@store');
Route::get('/employees/{employee}','EmployeeController@show');
Route::get('/employees/{employee}/edit','EmployeeController@edit');
Route::patch('/employees/{employee}','EmployeeController@update');

// Route::resource('bugs', 'BugController');
Route::get('/bugs','BugController@index');
Route::get('/bugs/create','BugController@create');
Route::post('/bugs','BugController@store');
Route::get('/bugs/{bug}','BugController@show');
Route::get('/bugs/{bug}/edit','BugController@edit');
Route::patch('/bugs/{bug}','BugController@update');

// Route::resource('users', 'UserController');
Route::get('/users','UserController@index');
Route::get('/users/create','UserController@create');
Route::post('/users','UserController@store');
Route::get('/users/{user}','UserController@show');
Route::get('/users/{user}/edit','UserController@edit');
Route::patch('/users/{user}','UserController@update');

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
Route::get('/payment_types/{payment_type}/edit','PaymentTypeController@edit');
Route::patch('/payment_types/{payment_type}/update','PaymentTypeController@update');

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

Route::get('/payments', 'PaymentController@index');
Route::get('/payments/{payment}', 'PaymentController@show');
Route::get('/payments/create/client/{client}', 'PaymentController@create');
Route::post('/payments', 'PaymentController@store');

//Management
Route::get('/sms_promotions', 'SMSPromotionController@index');
Route::get('/sms_promotions/create/', 'SMSPromotionController@create');
Route::post('/sms_promotions', 'SMSPromotionController@store');
Route::get('/reports/create/', 'ReportController@create');
Route::get('/reports', 'ReportController@index');
Route::post('/reports', 'ReportController@store');
Route::post('/reports/download', 'ReportController@download');
Route::delete('/reports/{rt_number}/delete', 'ReportController@delete');

//APIs
Route::get('/api/services', 'APIController@services');
Route::get('/api/products', 'APIController@products');
Route::get('/api/packages', 'APIController@packages');
Route::get('/api/employees', 'APIController@employees');
Route::get('/api/clients', 'APIController@clients');

Route::get('/api/sales_orders', 'APIController@sales_orders');
Route::get('/api/payments', 'APIController@payments');
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
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

//Auth::routes();

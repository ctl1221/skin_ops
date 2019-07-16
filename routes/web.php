<?php

Route::get('/','UserController@home');
Route::get('/dashboard','UserController@dashboard');
Route::get('/settings','UserController@settings');
Route::post('/settings','UserController@postSettings');
Route::post('/userpass','UserController@updatePassword');
Route::post('/userroles','UserController@updateRoles');

Route::get('/m_dashboard','SystemController@m_dashboard')->middleware('role:management');;
Route::get('/system_settings','UserController@systemSettings')->middleware('role:management');
Route::post('/system_settings','UserController@postSystemSettings')->middleware('role:management');

//Master Data
Route::get('/clients/search', 'ClientController@search')->middleware('role:sales');

// Route::resource('clients', 'ClientController');
Route::get('/clients','ClientController@index')->middleware('role:management');
Route::get('/clients/create','ClientController@create')->middleware('role:sales');
Route::post('/clients','ClientController@store')->middleware('role:sales');
Route::get('/clients/{client}','ClientController@show')->middleware('role:sales');
Route::get('/clients/{client}/edit','ClientController@edit')->middleware('role:sales');
Route::patch('/clients/{client}','ClientController@update')->middleware('role:sales');

// Route::resource('products', 'ProductController');
Route::get('/products','ProductController@index')->middleware('role:management');
Route::get('/products/create','ProductController@create')->middleware('role:management');
Route::post('/products','ProductController@store')->middleware('role:management');
Route::get('/products/{product}','ProductController@show')->middleware('role:management');
Route::get('/products/{product}/edit','ProductController@edit')->middleware('role:management');
Route::patch('/products/{product}','ProductController@update')->middleware('role:management');

// Route::resource('services', 'ServiceController');
Route::get('/services','ServiceController@index')->middleware('role:management');
Route::get('/services/create','ServiceController@create')->middleware('role:management');
Route::post('/services','ServiceController@store')->middleware('role:management');
Route::get('/services/{service}','ServiceController@show')->middleware('role:management');
Route::get('/services/{service}/edit','ServiceController@edit')->middleware('role:management');
Route::patch('/services/{service}','ServiceController@update')->middleware('role:management');

// Route::resource('packages', 'PackageController');
Route::get('/packages','PackageController@index')->middleware('role:management');
Route::get('/packages/create','PackageController@create')->middleware('role:management');
Route::post('/packages','PackageController@store')->middleware('role:management');
Route::get('/packages/{package}','PackageController@show')->middleware('role:management');
Route::get('/packages/{package}/edit','PackageController@edit')->middleware('role:management');
Route::patch('/packages/{package}','PackageController@update')->middleware('role:management');

// Route::resource('employees', 'EmployeeController');
Route::get('/employees','EmployeeController@index')->middleware('role:management');
Route::get('/employees/create','EmployeeController@create')->middleware('role:management');
Route::post('/employees','EmployeeController@store')->middleware('role:management');
Route::get('/employees/{employee}','EmployeeController@show')->middleware('role:management');
Route::get('/employees/{employee}/edit','EmployeeController@edit')->middleware('role:management');
Route::patch('/employees/{employee}','EmployeeController@update')->middleware('role:management');

// Route::resource('bugs', 'BugController');
Route::get('/bugs','BugController@index')->middleware('role:admin');
Route::get('/bugs/create','BugController@create')->middleware('role:sales');
Route::post('/bugs','BugController@store')->middleware('role:sales');
Route::get('/bugs/{bug}','BugController@show')->middleware('role:admin');

// Route::resource('users', 'UserController');
Route::get('/users','UserController@index')->middleware('role:admin');
Route::get('/users/create','UserController@create')->middleware('role:admin');
Route::post('/users','UserController@store')->middleware('role:admin');
Route::get('/users/{user}','UserController@show')->middleware('role:admin');
Route::get('/users/{user}/edit','UserController@edit')->middleware('role:admin');
Route::patch('/users/{user}','UserController@update')->middleware('role:admin');

Route::get('/branches','BranchController@index')->middleware('role:management');
Route::get('/branches/create','BranchController@create')->middleware('role:management');
Route::post('/branches','BranchController@store')->middleware('role:management');
Route::get('/branches/{branch}/edit','BranchController@edit')->middleware('role:management');
Route::post('/branches/{branch}','BranchController@update')->middleware('role:management');

Route::get('/pricelists','PricelistController@index')->middleware('role:management');
Route::get('/pricelists/create','PricelistController@create')->middleware('role:management');
Route::post('/pricelists','PricelistController@store')->middleware('role:management');
Route::get('/pricelists/edit','PricelistController@edit')->middleware('role:management');
Route::post('/pricelists/update','PricelistController@update')->middleware('role:management');

Route::get('/payment_types','PaymentTypeController@index')->middleware('role:management');
Route::get('/payment_types/create','PaymentTypeController@create')->middleware('role:management');
Route::post('/payment_types','PaymentTypeController@store')->middleware('role:management');
Route::get('/payment_types/{payment_type}/edit','PaymentTypeController@edit')->middleware('role:management');
Route::patch('/payment_types/{payment_type}/update','PaymentTypeController@update')->middleware('role:management');

Route::get('/memberships','MembershipController@index')->middleware('role:management');
Route::get('/memberships/create','MembershipController@create')->middleware('role:management');
Route::post('/memberships','MembershipController@store')->middleware('role:management');
Route::get('/memberships/{membership}/edit','MembershipController@edit')->middleware('role:management');
Route::post('/memberships/update','MembershipController@update')->middleware('role:management');

//Modify
Route::get('/products/{product}/deactivate', 'ProductController@deactivate')->middleware('role:management');
Route::get('/products/{product}/activate', 'ProductController@activate')->middleware('role:management');

Route::get('/services/{service}/deactivate', 'ServiceController@deactivate')->middleware('role:management');
Route::get('/services/{service}/activate', 'ServiceController@activate')->middleware('role:management');

Route::get('/packages/{package}/deactivate', 'PackageController@deactivate')->middleware('role:management');
Route::get('/packages/{package}/activate', 'PackageController@activate')->middleware('role:management');

Route::post('/branches/{branch}/deactivate', 'BranchController@deactivate')->middleware('role:management');
Route::post('/branches/{branch}/activate', 'BranchController@activate')->middleware('role:management');

Route::get('/employees/{employee}/deactivate', 'EmployeeController@deactivate')->middleware('role:management');
Route::get('/employees/{employee}/activate', 'EmployeeController@activate')->middleware('role:management');

Route::get('/clients/{client}/claim', 'ClientController@claim')->middleware('role:sales');
Route::post('/clients/{client}/claim', 'ClientController@claimPost')->middleware('role:sales');
Route::get('/clients/{client}/deactivate', 'ClientController@deactivate')->middleware('role:management');
Route::get('/clients/{client}/activate', 'ClientController@activate')->middleware('role:management');

Route::get('/pricelists/{pricelist}/deactivate', 'PricelistController@deactivate')->middleware('role:management');
Route::get('/pricelists/{pricelist}/activate', 'PricelistController@activate')->middleware('role:management');

Route::post('/payment_types/{paymentType}/deactivate', 'PaymentTypeController@deactivate')->middleware('role:management');
Route::post('/payment_types/{paymentType}/activate', 'PaymentTypeController@activate')->middleware('role:management');

Route::post('/memberships/{membership}/deactivate', 'MembershipController@deactivate')->middleware('role:management');
Route::post('/memberships/{membership}/activate', 'MembershipController@activate')->middleware('role:management');

Route::get('/bugs/{bug}/close', 'BugController@close')->middleware('role:admin');
Route::get('/bugs/{bug}/open', 'BugController@open')->middleware('role:admin');
Route::get('/bugs/{bug}/delete', 'BugController@delete')->middleware('role:admin');

//Transactional Data
Route::get('/sales_orders', 'SalesOrderController@index')->middleware('role:sales');
Route::get('/sales_orders/create/client/{client}', 'SalesOrderController@create')->middleware('role:sales');
Route::get('/sales_orders/{sales_order}', 'SalesOrderController@show')->middleware('role:sales');
Route::post('/sales_orders', 'SalesOrderController@store')->middleware('role:sales');
Route::post('/sales_orders/{sales_order}/post', 'SalesOrderController@post')->middleware('role:sales');
Route::post('/sales_orders/{sales_order}/delete', 'SalesOrderController@destroy')->middleware('role:sales');

Route::get('/payments', 'PaymentController@index')->middleware('role:sales');
Route::get('/payments/{payment}', 'PaymentController@show')->middleware('role:sales');
Route::get('/payments/create/client/{client}', 'PaymentController@create')->middleware('role:sales');
Route::post('/payments', 'PaymentController@store')->middleware('role:sales');
Route::post('/payments/{payment}', 'PaymentController@destroy')->middleware('role:management');

//Management
Route::get('/sms_promotions', 'SMSPromotionController@index')->middleware('role:management');
Route::get('/sms_promotions/create/', 'SMSPromotionController@create')->middleware('role:management');
Route::post('/sms_promotions', 'SMSPromotionController@store')->middleware('role:management');

Route::get('/reports/create/', 'ReportController@create')->middleware('role:management');
Route::get('/reports', 'ReportController@index')->middleware('role:management');
Route::post('/reports', 'ReportController@store')->middleware('role:management');
Route::post('/reports/download', 'ReportController@download')->middleware('role:management');
Route::delete('/reports/{rt_number}/delete', 'ReportController@delete')->middleware('role:management');

//APIs
Route::get('/api/services', 'APIController@services')->middleware('role:management');
Route::get('/api/products', 'APIController@products')->middleware('role:management');
Route::get('/api/packages', 'APIController@packages')->middleware('role:management');
Route::get('/api/employees', 'APIController@employees')->middleware('role:management');
Route::get('/api/clients', 'APIController@clients')->middleware('role:sales');

Route::get('/api/sales_orders', 'APIController@sales_orders')->middleware('role:sales');
Route::get('/api/payments', 'APIController@payments')->middleware('role:sales');
Route::post('/api/clients/search', 'APIController@client_search')->middleware('role:sales');
Route::post('/api/appointments', 'APIController@appointments')->middleware('role:sales');

Route::get('/appointments', 'AppointmentController@index')->middleware('role:sales');
Route::post('/appointments', 'AppointmentController@store')->middleware('role:sales');
Route::post('/appointments/{appointment}/edit', 'AppointmentController@edit')->middleware('role:sales');
Route::post('/appointments/{appointment}/delete', 'AppointmentController@delete')->middleware('role:sales');

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

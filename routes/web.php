<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', function () {
  return redirect('/login');
});

Route::group(['middleware' => 'auth'], function(){
  Route::get('/', function(){
    return redirect('/dashboard');
  });
  Route::resource('dashboard', 'DashboardController');
  Route::resource('client', 'ClientController');
  Route::resource('address', 'AddressController');
  Route::resource('contact', 'ContactController');
  Route::resource('employee', 'EmployeeController');
  Route::resource('invoice', 'InvoiceController');
  Route::resource('company', 'CompanyController');
  Route::resource('user', 'UserController');
  Route::resource('recurring-payment', 'RecurringPaymentController');
  Route::get('invoice-print/{id}', 'InvoiceController@showPrint');
  Route::get('ajax-client/{id}', 'ClientController@ajaxShow');
  Route::get('ajax-tax', 'TaxController@ajaxIndex');
  Route::get('company-export', 'CompanyController@export');
  Route::post('company-export', 'CompanyController@makeExport');
});
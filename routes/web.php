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
  Route::resource('bill', 'BillController');
  Route::resource('company', 'CompanyController');
  Route::resource('user', 'UserController');
  Route::resource('recurring-payment', 'RecurringPaymentController');
  Route::get('invoice-print/{id}', 'InvoiceController@showPrint');
  Route::post('invoice-send/{id}', 'InvoiceController@sendInvoice');
  Route::get('bill-print/{id}', 'BillController@showPrint');
  Route::post('bill-send/{id}', 'BillController@sendBill');
  Route::get('ajax-client/{id}', 'ClientController@ajaxShow');
  Route::get('ajax-tax', 'TaxController@ajaxIndex');
  Route::get('company-export', 'CompanyController@export');
  Route::post('company-export', 'CompanyController@makeExport');
  Route::resource('mileage', 'MileageController');
  Route::get('mileage-print/{id}', 'MileageController@showPrint');
  Route::get('mileage-record/{id}', 'MileageRecordController@index');
  Route::get('mileage-record/create/{id}', 'MileageRecordController@create');
  Route::post('mileage-record', 'MileageRecordController@store');
  Route::get('mileage-record/{id}/edit', 'MileageRecordController@edit');
  Route::put('mileage-record/{id}', 'MileageRecordController@update');
  Route::delete('mileage-record/{id}', 'MileageRecordController@destroy');
  Route::get('contract-type',  'ContractTypeController@index');
  Route::get('contract-type/create', 'ContractTypeController@create');
  Route::post('contract-type',  'ContractTypeController@store');
  Route::delete('contract-type/{id}', 'ContractTypeController@destroy');
  Route::get('ajax-contract-type/{id}', 'ContractTypeController@ajaxShow');
  Route::get('contract',  'ContractController@index');
  Route::get('contract/create', 'ContractController@create');
  Route::get('contract/{id}',  'ContractController@show');
  Route::post('contract',  'ContractController@store');
  Route::delete('contract/{id}', 'ContractController@destroy');
  Route::post('contract/{id}/send',  'ContractController@sendEmail');
  Route::get('/hosting', 'HostingController@index');
  Route::get('/hosting/create', 'HostingController@create');
  Route::get('/hosting/{id}', 'HostingController@show');
  Route::get('/hosting/{id}/edit', 'HostingController@edit');
  Route::match(['PUT', 'PATCH'], '/hosting/{id}', 'HostingController@update');
  Route::post('/hosting', 'HostingController@store');
  Route::post('/hosting/{id}/finish', 'HostingController@finish');
  Route::post('/hosting/{id}/unfinish', 'HostingController@unfinish');
  Route::get('/hosting/{hostingId}/cycle/create', 'HostingCycleController@create');
  Route::get('/hosting/{hostingId}/cycle/{hostingCycleId}/edit', 'HostingCycleController@edit');
  Route::get('/hosting/{hostingId}/cycle/{hostingCycleId}/update', 'HostingCycleController@edit');
  Route::post('/hosting/{hostingId}/cycle/{hostingCycleId}/unpaid', 'HostingCycleController@unpaid');
  Route::post('/hosting/{hostingId}/cycle/{hostingCycleId}/paid', 'HostingCycleController@paid');
  Route::match(['PUT', 'PATCH'], '/hosting/{hostingId}/cycle/{hostingCycleId}', 'HostingCycleController@update');
  Route::post('/hosting/{hostingId}/cycle', 'HostingCycleController@store');
  Route::delete('/hosting/{hostingId}/cycle/{hostingCycleId}/destroy', 'HostingCycleController@destroy');
});

Route::get('/umowa/{slug}', 'ContractController@sign');
Route::post('/ajax-umowa-sms/{slug}', 'ContractController@ajaxSendSms');
Route::post('/ajax-umowa-sms-sprawdz/{slug}', 'ContractController@ajaxSendSmsCheck');
Route::post('/umowa/{slug}', 'ContractController@processSign');
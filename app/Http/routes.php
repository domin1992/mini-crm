<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// user not logged in
Route::group(['middleware' => 'web'], function(){
    Route::auth();

    Route::get('/', function () {
      return redirect('/login');
    });

});

// App / user logged in
Route::group(['middleware' => ['web', 'auth']], function(){
  Route::get('/', function(){
    return view('dashboard');
  });
  Route::resource('client', 'ClientController');
  Route::resource('address', 'AddressController');
  Route::resource('contact', 'ContactController');
  Route::resource('employee', 'EmployeeController');
  Route::resource('invoice', 'InvoiceController');
  Route::get('invoice-print/{id}', 'InvoiceController@showPrint');
  Route::get('ajax-client/{id}', 'ClientController@ajaxShow');
  Route::get('ajax-tax', 'TaxController@ajaxIndex');
});
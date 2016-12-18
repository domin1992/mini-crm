<?php

namespace App\Libraries;

class AvailableControllers{
  private static $controllers = [
    ['name' => 'App\Http\Controllers\ClientController', 'display' => 'Client'],
    ['name' => 'App\Http\Controllers\CompanyController', 'display' => 'Company'],
    ['name' => 'App\Http\Controllers\EmployeeController', 'display' => 'Employee'],
    ['name' => 'App\Http\Controllers\InvoiceController', 'display' => 'Invoice'],
    ['name' => 'App\Http\Controllers\UserController', 'display' => 'User'],
  ];

  public static function getControllers(){
    return self::$controllers;
  }

  public static function getController($index){
    return self::$controllers[$index];
  }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tax;

class TaxController extends Controller
{
  public function ajaxIndex(){
    $taxes = Tax::all();

    return response()->json($taxes);
  }
}

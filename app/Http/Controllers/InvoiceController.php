<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Invoice;
use App\InvoicePosition;
use App\Owner;

use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $invoices = Invoice::all();

      return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      return view('invoice.create', ['request' => $request]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $invoice = Invoice::create($request->all());

      $positionsList = explode(',', $request->input('positions_list'));
      foreach($positionsList as $position){
        $invoicePosition = new InvoicePosition;
        $invoicePosition->invoice_id = $invoice->id;
        $invoicePosition->name = $request->input($position.'_name');
        $invoicePosition->quantity = $request->input($position.'_quantity');
        $invoicePosition->measure_unit = $request->input($position.'_measure_unit');
        $invoicePosition->price_tax_excl = str_replace(',', '.', $request->input($position.'_price_tax_excl'));
        $invoicePosition->tax_id = $request->input($position.'_tax_id');
        $invoicePosition->save();
      }

      return redirect('/invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $invoice = Invoice::find($id);
      $issueDate = Carbon::createFromFormat('Y-m-d', $invoice->issue_date);
      $invoice->issue_date = $issueDate->format('d-m-Y');
      $invoice->sumPositionsValueTaxExcl = 0.0;
      $invoice->sumPositionsTaxValue = 0.0;
      $invoice->sumPositionsValueTaxIncl = 0.0;
      foreach($invoice->invoicePositions()->get() as $position){
        $invoice->sumPositionsValueTaxExcl += $position->price_tax_excl;
        foreach($position->tax()->get() as $tax){
          $invoice->sumPositionsTaxValue += $tax->value * ($position->price_tax_excl * $position->quantity);
          $invoice->sumPositionsValueTaxIncl += $tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity);
        }
      }

      $owner = Owner::first();

      return view('invoice.show', ['invoice' => $invoice, 'owner' => $owner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $invoice = Invoice::find($id);
      $invoice->delete();

      return redirect('/invoice');
    }

    public function showPrint($id)
    {
      $invoice = Invoice::find($id);
      $issueDate = Carbon::createFromFormat('Y-m-d', $invoice->issue_date);
      $invoice->issue_date = $issueDate->format('d-m-Y');
      $invoice->sumPositionsValueTaxExcl = 0.0;
      $invoice->sumPositionsTaxValue = 0.0;
      $invoice->sumPositionsValueTaxIncl = 0.0;
      foreach($invoice->invoicePositions()->get() as $position){
        $invoice->sumPositionsValueTaxExcl += $position->price_tax_excl;
        foreach($position->tax()->get() as $tax){
          $invoice->sumPositionsTaxValue += $tax->value * ($position->price_tax_excl * $position->quantity);
          $invoice->sumPositionsValueTaxIncl += $tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity);
        }
      }

      $owner = Owner::first();

      return view('invoice.show-print', ['invoice' => $invoice, 'owner' => $owner]);
    }
}

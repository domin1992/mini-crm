<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Invoice;
use App\InvoicePosition;
use App\Owner;
use App\Libraries\Generator;
use App\Mail\InvoiceCreated;
use Carbon\Carbon;
use Storage;
use Response;
use Mail;

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
        $invoice = new Invoice;
        $invoice->client_id = $request->client_id;
        $invoice->address_id = $request->address_id;
        $issueDate = Carbon::createFromFormat('Y-m-d', $request->issue_date);
        $invoicesCount = Invoice::where([['issue_date', '>=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-1')], ['issue_date', '<=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-31')]])->count();
        if($request->advance == 1)
            $invoice->invoice_number = 'FVZAL/'.$issueDate->format('Y/m').'/'.(($invoicesCount + 1) < 10 ? '0'.($invoicesCount + 1) : $invoicesCount + 1);
        else
            $invoice->invoice_number = 'FV/'.$issueDate->format('Y/m').'/'.(($invoicesCount + 1) < 10 ? '0'.($invoicesCount + 1) : $invoicesCount + 1);
        $invoice->issue_city = $request->issue_city;
        $invoice->issue_date = $request->issue_date;
        $invoice->payment_date = $request->payment_date;
        $invoice->advance = $request->advance;
        $invoice->comment = $request->comment;
        $invoice->payment_method_id = $request->payment_method_id;
        $invoice->paid = ($request->paid == 'on' ? 1 : 0);
        $invoice->save();

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

        Generator::generateInvoicePdf($invoice->id);

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
        $paymentDate = Carbon::createFromFormat('Y-m-d', $invoice->payment_date);
        $invoice->payment_date = $paymentDate->format('d-m-Y');
        $invoice->sumPositionsValueTaxExcl = 0.0;
        $invoice->sumPositionsTaxValue = 0.0;
        $invoice->sumPositionsValueTaxIncl = 0.0;
        foreach($invoice->invoicePositions()->get() as $position){
            $invoice->sumPositionsValueTaxExcl += $position->price_tax_excl * $position->quantity;
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
        if(!Storage::disk('docs')->exists(str_replace('/', '_', $invoice->invoice_number).'.pdf')){
            Generator::generateInvoicePdf($invoice->id);
        }
        return Response::make(Storage::disk('docs')->get(str_replace('/', '_', $invoice->invoice_number).'.pdf'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.str_replace('/', '_', $invoice->invoice_number).'.pdf'.'"'
        ]);
    }

    public function sendInvoice(Request $request, $id){
        $invoice = Invoice::find($id);
        if(!Storage::disk('docs')->exists(str_replace('/', '_', $invoice->invoice_number).'.pdf')){
            Generator::generateInvoicePdf($invoice->id);
        }
        Mail::to($request->email)->send(new InvoiceCreated($invoice));
        return redirect('/invoice/'.$id);
    }
}

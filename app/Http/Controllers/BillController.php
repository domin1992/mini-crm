<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BillPosition;
use App\Owner;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();

        return view('bill.index', ['bills' => $bills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bill = new Bill;
        $bill->client_id = $request->client_id;
        $bill->address_id = $request->address_id;
        $issueDate = Carbon::createFromFormat('Y-m-d', $request->issue_date);
        $billsCount = Bill::where([['issue_date', '>=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-1')], ['issue_date', '<=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-31')]])->count();
        $bill->bill_number = 'R/'.$issueDate->format('Y/m').'/'.(($billsCount + 1) < 10 ? '0'.($billsCount + 1) : $billsCount + 1);
        $bill->issue_city = $request->issue_city;
        $bill->issue_date = $request->issue_date;
        $bill->sell_date = $request->sell_date;
        $bill->payment_method = $request->payment_method;
        $bill->save();


        $positionsList = explode(',', $request->input('positions_list'));
        foreach($positionsList as $position){
            $billPosition = new BillPosition;
            $billPosition->bill_id = $bill->id;
            $billPosition->name = $request->input($position.'_name');
            $billPosition->quantity = $request->input($position.'_quantity');
            $billPosition->measure_unit = $request->input($position.'_measure_unit');
            $billPosition->price_tax_excl = str_replace(',', '.', $request->input($position.'_price_tax_excl'));
            $billPosition->tax_id = $request->input($position.'_tax_id');
            $billPosition->save();
        }

        return redirect('/bill');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::find($id);
        $issueDate = Carbon::createFromFormat('Y-m-d', $bill->issue_date);
        $bill->issue_date = $issueDate->format('d-m-Y');
        $sellDate = Carbon::createFromFormat('Y-m-d', $bill->sell_date);
        $bill->sell_date = $sellDate->format('d-m-Y');
        $bill->sumPositionsValueTaxExcl = 0.0;
        $bill->sumPositionsTaxValue = 0.0;
        $bill->sumPositionsValueTaxIncl = 0.0;
        foreach($bill->billPositions()->get() as $position){
            $bill->sumPositionsValueTaxExcl += $position->price_tax_excl * $position->quantity;
            foreach($position->tax()->get() as $tax){
                $bill->sumPositionsTaxValue += $tax->value * ($position->price_tax_excl * $position->quantity);
                $bill->sumPositionsValueTaxIncl += $tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity);
            }
        }

        $owner = Owner::first();

        return view('bill.show', ['bill' => $bill, 'owner' => $owner]);
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
        $bill = Bill::find($id);
        $bill->delete();

        return redirect('/bill');
    }

    public function showPrint($id)
    {
        $bill = Bill::find($id);
        $issueDate = Carbon::createFromFormat('Y-m-d', $bill->issue_date);
        $bill->issue_date = $issueDate->format('d-m-Y');
        $sellDate = Carbon::createFromFormat('Y-m-d', $bill->sell_date);
        $bill->sell_date = $sellDate->format('d-m-Y');
        $bill->sumPositionsValueTaxExcl = 0.0;
        $bill->sumPositionsTaxValue = 0.0;
        $bill->sumPositionsValueTaxIncl = 0.0;
        foreach($bill->billPositions()->get() as $position){
            $bill->sumPositionsValueTaxExcl += $position->price_tax_excl * $position->quantity;
            foreach($position->tax()->get() as $tax){
                $bill->sumPositionsTaxValue += $tax->value * ($position->price_tax_excl * $position->quantity);
                $bill->sumPositionsValueTaxIncl += $tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity);
            }
        }

        $owner = Owner::first();

        return view('bill.show-print', ['bill' => $bill, 'owner' => $owner]);
    }
}

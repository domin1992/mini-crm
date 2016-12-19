<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RecurringPayment;

use Carbon\Carbon;

class RecurringPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $recurringPayments = RecurringPayment::all();

      foreach($recurringPayments as &$recurringPayment){
        $periodStart = Carbon::createFromFormat('Y-m-d H:i:s', $recurringPayment->period_start);
        switch($recurringPayment->period){
          case 1:
            $periodEnd = $periodStart->addDays($recurringPayment->period_count);
            break;
          case 2:
            $periodEnd = $periodStart->addWeeks($recurringPayment->period_count);
            break;
          case 3:
            $periodEnd = $periodStart->addMonths($recurringPayment->period_count);
            break;
          case 4:
            $periodEnd = $periodStart->addYears($recurringPayment->period_count);
            break;
        }
        $recurringPayment->period_end = $periodEnd->format('Y-m-d H:i:s');
      }

      return view('recurring-payment.index', compact('recurringPayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('recurring-payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // RecurringPayment::create($request->all());
      $recurringPayment = new RecurringPayment;
      $recurringPayment->client_id = $request->input('client_id');
      $recurringPayment->name = $request->input('name');
      $recurringPayment->description = $request->input('description');
      $recurringPayment->period_count = $request->input('period_count');
      $recurringPayment->period = $request->input('period');
      $periodStart = Carbon::createFromFormat('Y-m-d H:i', $request->input('period_start_date').' '.$request->input('period_start_time'));
      $recurringPayment->period_start = $periodStart->format('Y-m-d H:i:s');
      $recurringPayment->price = $request->input('price');
      $recurringPayment->save();

      return redirect('/recurring-payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $recurringPayment = RecurringPayment::find($id);

      $periodStart = Carbon::createFromFormat('Y-m-d H:i:s', $recurringPayment->period_start);
      switch($recurringPayment->period){
        case 1:
          $periodEnd = $periodStart->addDays($recurringPayment->period_count);
          break;
        case 2:
          $periodEnd = $periodStart->addWeeks($recurringPayment->period_count);
          break;
        case 3:
          $periodEnd = $periodStart->addMonths($recurringPayment->period_count);
          break;
        case 4:
          $periodEnd = $periodStart->addYears($recurringPayment->period_count);
          break;
      }
      $recurringPayment->period_end = $periodEnd->format('Y-m-d H:i:s');

      return view('recurring-payment.show', compact('recurringPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $recurringPayment = RecurringPayment::find($id);

      $recurringPayment->period_start_date = Carbon::createFromFormat('Y-m-d H:i:s', $recurringPayment->period_start)->format('Y-m-d');
      $recurringPayment->period_start_time = Carbon::createFromFormat('Y-m-d H:i:s', $recurringPayment->period_start)->format('H:i');

      return view('recurring-payment.edit', compact('recurringPayment'));
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
      $recurringPayment = RecurringPayment::find($id);
      $recurringPayment->client_id = $request->input('client_id');
      $recurringPayment->name = $request->input('name');
      $recurringPayment->description = $request->input('description');
      $recurringPayment->period_count = $request->input('period_count');
      $recurringPayment->period = $request->input('period');
      $periodStart = Carbon::createFromFormat('Y-m-d H:i', $request->input('period_start_date').' '.$request->input('period_start_time'));
      $recurringPayment->period_start = $periodStart->format('Y-m-d H:i:s');
      $recurringPayment->price = $request->input('price');
      $recurringPayment->save();

      return redirect('/recurring-payment/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $recurringPayment = RecurringPayment::find($id);
      $recurringPayment->delete();

      return redirect('/recurring-payment');
    }
}

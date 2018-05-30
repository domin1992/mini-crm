<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hosting;
use App\HostingCycle;
use Carbon\Carbon;

class HostingCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hostingId)
    {
        $hosting = Hosting::find($hostingId);

        return view('hosting-cycle.create', ['hosting' => $hosting]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $hostingId)
    {
        $hosting = Hosting::find($hostingId);
        $hostingCycle = new HostingCycle;
        $hostingCycle->hosting_id = $hosting->id;
        $hostingCycle->start_date = Carbon::createFromFormat('Y-m-d H:i', $request->input('start_date').' '.$request->input('start_time'))->format('Y-m-d H:i:s');
        $periodStart = Carbon::createFromFormat('Y-m-d H:i:s', $hostingCycle->start_date);
        switch($request->period){
          case 1:
            $periodEnd = $periodStart->addDays($request->period_count);
            break;
          case 2:
            $periodEnd = $periodStart->addWeeks($request->period_count);
            break;
          case 3:
            $periodEnd = $periodStart->addMonths($request->period_count);
            break;
          case 4:
            $periodEnd = $periodStart->addYears($request->period_count);
            break;
        }
        $hostingCycle->end_date = $periodEnd;
        $hostingCycle->period_count = $request->period_count;
        $hostingCycle->period = $request->period;
        $hostingCycle->paid = ($request->paid == 'on' ? true : false);
        $hostingCycle->price_tax_excl = $request->price_tax_excl;
        $hostingCycle->save();

        return redirect('/hosting/'.$hosting->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($hostingId, $hostingCycleId)
    {
        $hosting = Hosting::find($hostingId);
        $hostingCycle = HostingCycle::find($hostingCycleId);

        return view('hosting-cycle.edit', ['hosting' => $hosting, 'hostingCycle' => $hostingCycle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hostingId, $hostingCycleId)
    {
        $hosting = Hosting::find($hostingId);
        $hostingCycle = HostingCycle::find($hostingCycleId);
        $hostingCycle->start_date = Carbon::createFromFormat('Y-m-d H:i', $request->input('start_date').' '.$request->input('start_time'))->format('Y-m-d H:i:s');
        $periodStart = Carbon::createFromFormat('Y-m-d H:i:s', $hostingCycle->start_date);
        switch($request->period){
          case 1:
            $periodEnd = $periodStart->addDays($request->period_count);
            break;
          case 2:
            $periodEnd = $periodStart->addWeeks($request->period_count);
            break;
          case 3:
            $periodEnd = $periodStart->addMonths($request->period_count);
            break;
          case 4:
            $periodEnd = $periodStart->addYears($request->period_count);
            break;
        }
        $hostingCycle->end_date = $periodEnd;
        $hostingCycle->period_count = $request->period_count;
        $hostingCycle->period = $request->period;
        $hostingCycle->paid = ($request->paid == 'on' ? true : false);
        $hostingCycle->price_tax_excl = $request->price_tax_excl;
        $hostingCycle->save();

        return redirect('/hosting/'.$hosting->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($hostingId, $hostingCycleId)
    {
        $hosting = Hosting::find($hostingId);
        $hostingCycle = HostingCycle::find($hostingCycleId);
        $hostingCycle->delete();

        return redirect('/hosting/'.$hosting->id);
    }

    public function unpaid(Request $request, $hostingId, $hostingCycleId){
        $hosting = Hosting::find($hostingId);
        $hostingCycle = HostingCycle::find($hostingCycleId);
        $hostingCycle->paid = false;
        $hostingCycle->save();
        return redirect('/hosting/'.$hosting->id);
    }

    public function paid(Request $request, $hostingId, $hostingCycleId){
        $hosting = Hosting::find($hostingId);
        $hostingCycle = HostingCycle::find($hostingCycleId);
        $hostingCycle->paid = true;
        $hostingCycle->save();
        return redirect('/hosting/'.$hosting->id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hosting;
use App\HostingCycle;
use Carbon\Carbon;

class HostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostings = Hosting::all();

        return view('hosting.index', ['hostings' => $hostings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hosting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hosting = new Hosting;
        $hosting->client_id = $request->client_id;
        $hosting->account_name = $request->account_name;
        $hosting->email = $request->email;
        $hosting->package = $request->package;
        $hosting->package_slug = $request->package_slug;
        $hosting->price_tax_excl = $request->price_tax_excl;
        $hosting->start_date = Carbon::createFromFormat('Y-m-d H:i', $request->input('period_start_date').' '.$request->input('period_start_time'))->format('Y-m-d H:i:s');
        $hosting->finishing = false;
        $hosting->save();

        $hostingCycle = new HostingCycle;
        $hostingCycle->hosting_id = $hosting->id;
        $hostingCycle->start_date = Carbon::createFromFormat('Y-m-d H:i', $request->input('period_start_date').' '.$request->input('period_start_time'))->format('Y-m-d H:i:s');
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
        $hostingCycle->paid = true;
        $hostingCycle->price_tax_excl = $request->price_tax_excl;
        $hostingCycle->save();

        return redirect('/hosting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hosting = Hosting::find($id);

        return view('hosting.show', ['hosting' => $hosting]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hosting = Hosting::find($id);

        return view('hosting.edit', ['hosting' => $hosting]);
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
        $hosting = Hosting::find($id);
        $hosting->client_id = $request->client_id;
        $hosting->account_name = $request->account_name;
        $hosting->email = $request->email;
        $hosting->package = $request->package;
        $hosting->package_slug = $request->package_slug;
        $hosting->price_tax_excl = $request->price_tax_excl;
        $hosting->start_date = Carbon::createFromFormat('Y-m-d H:i', $request->input('start_date').' '.$request->input('start_time'))->format('Y-m-d H:i:s');
        $hosting->finishing = ($request->finishing == 'on' ? false : true);
        $hosting->save();

        return redirect('/hosting/'.$hosting->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function finish($id){
        $hosting = Hosting::find($id);
        $hosting->finishing = true;
        $hosting->save();

        return redirect('/hosting/'.$hosting->id);
    }

    public function unfinish($id){
        $hosting = Hosting::find($id);
        $hosting->finishing = false;
        $hosting->save();

        return redirect('/hosting/'.$hosting->id);
    }
}

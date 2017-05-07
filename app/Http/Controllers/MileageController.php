<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mileage;
use App\MileageRecord;
use App\Owner;
use Carbon\Carbon;

class MileageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mileages = Mileage::all();

        return view('mileage.index', ['mileages' => $mileages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mileage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mileage = new Mileage;
        $mileage->mileage_month = $request->input('mileage_month');
        $mileage->mileage_year = $request->input('mileage_year');
        $mileage->registration_number = $request->input('registration_number');
        $mileage->engine_capacity = $request->input('engine_capacity');
        $mileage->save();

        return redirect('/mileage/'.$mileage->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mileage = Mileage::find($id);

        return view('mileage.show', ['mileage' => $mileage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mileage = Mileage::find($id);

        return view('mileage.edit', ['mileage' => $mileage]);
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
        $mileage = Mileage::find($id);
        $mileage->mileage_month = $request->input('mileage_month');
        $mileage->mileage_year = $request->input('mileage_year');
        $mileage->registration_number = $request->input('registration_number');
        $mileage->engine_capacity = $request->input('engine_capacity');
        $mileage->save();

        return redirect('/mileage/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mileage = Mileage::find($id);
        if($mileage->records()){
            foreach($mileage->records()->get() as $record){
                $record->delete();
            }
        }
        $mileage->delete();

        return redirect('/mileage');
    }

    public function showPrint($id){
        $mileage = Mileage::find($id);
        $owner = Owner::first();

        $mileage->sumDistance = 0.0;
        $mileage->sumValue = 0.0;
        if($mileage->records()){
            foreach($mileage->records()->get() as $mileageRecord){
                $mileage->sumDistance += $mileageRecord->distance;
                $mileage->sumValue += $mileageRecord->value;
            }
        }

        return view('mileage.show-print', ['mileage' => $mileage, 'owner' => $owner]);
    }
}

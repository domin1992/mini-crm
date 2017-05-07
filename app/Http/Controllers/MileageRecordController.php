<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mileage;
use App\MileageRecord;

class MileageRecordController extends Controller
{
    public function index($id){
        $mileage = Mileage::find($id);
        $mileageRecords = $mileage->records();

        return view('mileage-record.index', ['mileage' => $mileage, 'mileageRecords' => $mileageRecords]);
    }

    public function create($id){
        $mileage = Mileage::find($id);

        return view('mileage-record.create', ['mileage' => $mileage]);
    }

    public function store(Request $request){
        $mileageRecord = new MileageRecord;
        $mileageRecord->mileage_id = $request->input('mileage_id');
        $mileageRecord->departure = $request->input('departure');
        $mileageRecord->route_description = $request->input('route_description');
        $mileageRecord->reason = $request->input('reason');
        $mileageRecord->distance = $request->input('distance');
        $mileageRecord->rate = $request->input('rate');
        $mileageRecord->value = round((float)$mileageRecord->distance * (float)$mileageRecord->rate, 2);
        $mileageRecord->comments = $request->input('comments');
        $mileageRecord->save();

        return redirect('/mileage-record/'.$request->input('mileage_id'));
    }

    public function edit($id){
        $mileageRecord = MileageRecord::find($id);

        return view('mileage-record.edit', ['mileageRecord' => $mileageRecord]);
    }

    public function update(Request $request, $id){
        $mileageRecord = MileageRecord::find($id);
        $mileageRecord->departure = $request->input('departure');
        $mileageRecord->route_description = $request->input('route_description');
        $mileageRecord->reason = $request->input('reason');
        $mileageRecord->distance = $request->input('distance');
        $mileageRecord->rate = $request->input('rate');
        $mileageRecord->value = round((float)$mileageRecord->distance * (float)$mileageRecord->rate, 2);
        $mileageRecord->comments = $request->input('comments');
        $mileageRecord->save();

        return redirect('/mileage-record/'.$mileageRecord->mileage_id);
    }

    public function destroy($id){
        $mileageRecord = MileageRecord::find($id);
        $mileageId = $mileageRecord->mileage_id;
        $mileageRecord->delete();

        return redirect('/mileage-record/'.$mileageId);
    }
}

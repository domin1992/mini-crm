<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContractType;

class ContractTypeController extends Controller
{
    public function index(){
        $contractTypes = ContractType::all();

        return view('contract-type.index', ['contractTypes' => $contractTypes]);
    }

    public function create(){
        return view('contract-type.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'fields' => 'required|string',
        ]);

        $contractType = new ContractType;
        $contractType->name = $request->name;
        $contractType->slug = str_slug($request->name);
        $contractType->fields = serialize($contractType->fieldsTextToArray($request->fields));
        $contractType->email_content = $request->email_content;
        $contractType->save();

        return redirect('/contract-type');
    }

    public function destroy($id){
        $contractType = ContractType::find($id);
        $contractType->delete();

        return redirect('/contract-type');
    }

    public function ajaxShow(Request $request, $id){
        $contractType = ContractType::find($id);
        $contractType->fields = unserialize($contractType->fields);

        return response()->json($contractType);
    }
}

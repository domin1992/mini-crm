<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Libraries\Generator;
use App\Libraries\Helper;
use App\Libraries\SmsLabs;
use App\Mail\Contract as MailContract;
use App\Mail\ContractSigned;
use App\Contract;
use App\ContractType;
use App\ContractSignMethod;
use App\Owner;
use Mail;
use Response;

class ContractController extends Controller
{
    public function index(){
        $contracts = Contract::all();

        return view('contract.index', ['contracts' => $contracts]);
    }

    public function create(){
        return view('contract.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'contract_type_id' => 'required|integer|min:1',
            'contract_sign_method_id' => 'required|integer|min:1',
            'email' => 'required|string|email|max:255',
        ]);

        $contractType = ContractType::find($request->contract_type_id);
        $contractTypeFields = unserialize($contractType->fields);

        // dd($request->all());
        $predefinedFields = [];

        foreach($contractTypeFields as $contractTypeField){
            if($request[$contractTypeField['name']] != null && $request[$contractTypeField['name']] != ''){
                $predefinedFields[$contractTypeField['name']] = $request[$contractTypeField['name']];
            }
        }

        do{
            $slug = Helper::generateRandomString(32, 'nl');
        }while(Contract::where('slug', $slug)->first() != null);

        $contract = new Contract;
        $contract->slug = $slug;
        $contract->client_id = $request->client_id;
        $contract->contract_type_id = $request->contract_type_id;
        $contract->contract_sign_method_id = $request->contract_sign_method_id;
        $contract->email = $request->email;
        $contract->predefined_fields = serialize($predefinedFields);
        $contract->phone = $request->phone;
        $contract->save();

        return redirect('/contract');
    }

    public function show($id){
        $contract = Contract::find($id);
        if($contract != null){
            $contractFields = ($contract->fields ? unserialize($contract->fields) : unserialize($contract->predefined_fields));
            $contractTypeFields = unserialize($contract->type()->first()->fields);
            $contractFieldsDisplay = [];
            foreach($contractTypeFields as $contractTypeField){
                if(isset($contractFields[$contractTypeField['name']]) && $contractFields[$contractTypeField['name']] != null && $contractFields[$contractTypeField['name']] != ''){
                    $contractFieldsDisplay[] = array_merge($contractTypeField, ['value' => $contractFields[$contractTypeField['name']]]);
                }
            }

            return view('contract.show', ['contract' => $contract, 'contractFieldsDisplay' => $contractFieldsDisplay]);
        }
        return redirect('/contract');
    }

    public function sign($slug){
        $contract = Contract::where('slug', $slug)->first();
        $owner = Owner::all()->first();

        return view('contract.show-public', ['contract' => $contract, 'owner' => $owner]);
    }

    public function ajaxSendSms(Request $request, $slug){
        $contract = Contract::where('slug', $slug)->first();
        $smsCode = Helper::generateRandomString(6, 'nl');

        if($request->phone != null && $request->phone != '' && preg_match("/[0-9]{9}/", $request->phone) != false){
            $contract->phone = '+48'.$request->phone;
            $contract->sms_code = $smsCode;
            $contract->sms_code_sent_date = date('Y-m-d H:i:s');
            $contract->save();
            $sms = new SmsLabs;
            $sms->send(['+48'.$request->phone], 'Twój kod SMS: '.$smsCode.' Pozdrawiamy Zencore');

            return response()->json(['success' => 1]);
        }
        else{
            return response()->json(['success' => 0, 'msg' => 'Nieprawidłowy numer telefonu']);
        }
    }

    public function ajaxSendSmsCheck(Request $request, $slug){
        $contract = Contract::where('slug', $slug)->first();

        if($request->sms_code != null && $request->sms_code != '' && $request->sms_code == $contract->sms_code){
            return response()->json(['success' => 1]);
        }
        else{
            return response()->json(['success' => 0, 'msg' => 'Nieprawidłowy kod sms']);
        }
    }

    public function processSign(Request $request, $slug){
        $contract = Contract::where('slug', $slug)->first();
        $contractFields = [];
        foreach(unserialize($contract->type()->first()->fields) as $contractTypeField){
            if(isset($request[$contractTypeField['name']]) && $request[$contractTypeField['name']] != null && $request[$contractTypeField['name']] != ''){
                $contractFields[$contractTypeField['name']] = $request[$contractTypeField['name']];
            }
        }
        $owner = Owner::all()->first();
        if($request->sms_code != $contract->sms_code){
            $messageBag = new MessageBag;
            $messageBag->add('sms_code', 'Nieprawidłowy kod sms');
            return redirect()->back()->withInput()->withErrors($messageBag);
        }
        $contract->fields = serialize($contractFields);
        $contract->signed = true;
        $contract->signed_date = date('Y-m-d H:i:s');
        $contract->save();
        Generator::generateContract($contract->type()->first()->slug, $contract, $request, $owner);

        Mail::to($contract->email)->send(new ContractSigned($contract, $owner));

        return view('contract.show-public-success');
    }

    public function sendEmail(Request $request, $id){
        $contract = Contract::find($id);

        Mail::to($contract->email)->send(new MailContract($contract));

        return redirect('/contract/'.$contract->id);
    }
}

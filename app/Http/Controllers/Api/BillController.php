<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Address;
use App\Bill;
use App\BillPosition;
use App\Owner;
use App\PaymentMethod;
use App\Tax;
use Carbon\Carbon;
use mPDF;
use App\Libraries\Helper;
use App\Libraries\Generator;
use Mail;
use App\Mail\BillCreated;

class BillController extends Controller
{
    public function store(Request $request){
        /*
        Example
        {
            "client": {
                "company": "Firma 1",
                "email": "firma@firma.pl",
                "address": {
                    "street": "Warszawska 123",
                    "city": "Łódź",
                    "postcode": "91-503",
                    "country": "Polska"
                }
            },
            "bill": {
                "payment_method": "payu",
                "paid": 1,
                "positions": [
                    {
                        "name": "Pakiet 1000",
                        "quantity": 1,
                        "price_tax_excl": 350.00,
                        "tax": 0.23
                    }
                ]
            },
            "send_email": 1
        }
        */
        if($request->auth == env('API_KEY')){
            $json = json_decode($request->bill);
            if(($client = Client::where([['company', '=', $json->client->company]])->first()) == null){
                $client = new Client;
                $client->company = $json->client->company;
                $client->email = $json->client->email;
                $client->save();
            }

            if(($address = Address::where([['client_id', '=', $client->id], ['street', '=', $json->client->address->street], ['city', '=', $json->client->address->city], ['postcode', '=', $json->client->address->postcode], ['country', '=', $json->client->address->country]])->first()) == null){
                $address = new Address;
                $address->client_id = $client->id;
                $address->name = 'Główny';
                $address->street = $json->client->address->street;
                $address->city = $json->client->address->city;
                $address->postcode = $json->client->address->postcode;
                $address->country = $json->client->address->country;
                $address->save();
            }

            $bill = new Bill;
            $bill->client_id = $client->id;
            $bill->address_id = $address->id;
            $issueDate = Carbon::now();
            $billsCount = Bill::where([['issue_date', '>=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-1')], ['issue_date', '<=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-31')]])->count();
            $bill->bill_number = 'R/'.$issueDate->format('Y/m').'/'.(($billsCount + 1) < 10 ? '0'.($billsCount + 1) : $billsCount + 1);
            $bill->issue_city = 'Łódź';
            $bill->issue_date = $issueDate->format('Y-m-d');
            $bill->sell_date = $issueDate->format('Y-m-d');
            $bill->payment_method_id = PaymentMethod::where('module_name', $json->bill->payment_method)->first()->id;
            $bill->paid = $json->bill->paid;
            $bill->save();

            foreach($json->bill->positions as $position){
                $billPosition = new BillPosition;
                $billPosition->bill_id = $bill->id;
                $billPosition->name = $position->name;
                $billPosition->quantity = $position->quantity;
                $billPosition->measure_unit = 'szt';
                $billPosition->price_tax_excl = $position->price_tax_excl;
                $billPosition->tax_id = Tax::where('value', $position->tax)->first()->id;
                $billPosition->save();
            }

            Generator::generateBillPdf($bill->id);

            if($json->send_email == 1){
                Mail::to($json->client->email)->send(new BillCreated($bill));
            }

            return response()->json([
                'success' => 1
            ]);
        }
        else{
            return response()->json([
                'success' => 0,
                'msg' => 'Nieprawidłowy klucz api'
            ]);
        }
    }
}

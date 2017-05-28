<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Address;
use App\Invoice;
use App\InvoicePosition;
use App\Owner;
use App\PaymentMethod;
use App\Tax;
use Carbon\Carbon;
use mPDF;
use App\Libraries\Helper;
use App\Libraries\Generator;
use Mail;
use App\Mail\InvoiceCreated;

class InvoiceController extends Controller
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
            "invoice": {
                "payment_method": "payu",
                "paid": 1,
                "comment": "",
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
            $json = json_decode($request->invoice);
            if(isset($json->client->vat_number)){
                if(($client = Client::where('nip', $json->client->vat_number)->first()) == null){
                    $client = new Client;
                    $client->company = $json->client->company;
                    $client->nip = $json->client->vat_number;
                    $client->email = $json->client->email;
                    $client->save();
                }
            }
            else{
                if(($client = Client::where([['company', '=', $json->client->company]])->first()) == null){
                    $client = new Client;
                    $client->company = $json->client->company;
                    $client->email = $json->client->email;
                    $client->save();
                }
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

            $invoice = new Invoice;
            $invoice->client_id = $client->id;
            $invoice->address_id = $address->id;
            $issueDate = Carbon::now();
            $invoicesCount = Invoice::where([['issue_date', '>=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-1')], ['issue_date', '<=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-31')], ['advance', '=', 0]])->count();
            $invoice->invoice_number = 'FV/'.$issueDate->format('Y/m').'/'.(($invoicesCount + 1) < 10 ? '0'.($invoicesCount + 1) : $invoicesCount + 1);
            $invoice->issue_city = 'Łódź';
            $invoice->issue_date = $issueDate->format('Y-m-d');
            $paymentDate = Carbon::now()->addWeeks(2);
            $invoice->payment_date = $paymentDate;
            $invoice->advance = 0;
            $invoice->comment = $json->invoice->comment;
            $invoice->payment_method_id = PaymentMethod::where('module_name', $json->invoice->payment_method)->first()->id;
            $invoice->paid = $json->invoice->paid;
            $invoice->save();

            foreach($json->invoice->positions as $position){
                $invoicePosition = new InvoicePosition;
                $invoicePosition->invoice_id = $invoice->id;
                $invoicePosition->name = $position->name;
                $invoicePosition->quantity = $position->quantity;
                $invoicePosition->measure_unit = 'szt';
                $invoicePosition->price_tax_excl = $position->price_tax_excl;
                $invoicePosition->tax_id = Tax::where('value', $position->tax)->first()->id;
                $invoicePosition->save();
            }

            Generator::generateInvoicePdf($invoice->id);

            if($json->send_email == 1){
                Mail::to($json->client->email)->send(new InvoiceCreated($invoice));
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

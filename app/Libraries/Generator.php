<?php

namespace App\Libraries;

use App\Invoice;
use App\Bill;
use App\Owner;
use App\Libraries\Helper;
use Carbon\Carbon;

class Generator{
    public static function generateInvoicePdf($invoiceId){
        $invoice = Invoice::find($invoiceId);
        $issueDate = Carbon::createFromFormat('Y-m-d', $invoice->issue_date);
        $invoice->issue_date = $issueDate->format('d-m-Y');
        $paymentDate = Carbon::createFromFormat('Y-m-d', $invoice->payment_date);
        $invoice->payment_date = $paymentDate->format('d-m-Y');
        $invoice->sumPositionsValueTaxExcl = 0.0;
        $invoice->sumPositionsTaxValue = 0.0;
        $invoice->sumPositionsValueTaxIncl = 0.0;
        foreach($invoice->invoicePositions()->get() as $position){
            $invoice->sumPositionsValueTaxExcl += $position->price_tax_excl * $position->quantity;
            foreach($position->tax()->get() as $tax){
                $invoice->sumPositionsTaxValue += $tax->value * ($position->price_tax_excl * $position->quantity);
                $invoice->sumPositionsValueTaxIncl += $tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity);
            }
        }

        $owner = Owner::first();

        $mpdf = Helper::initMpdf();
        $mpdf->WriteHTML(file_get_contents(public_path().'/css/invoice.css'), 1);
        $mpdf->WriteHTML(view('invoice.generate-pdf', ['invoice' => $invoice, 'owner' => $owner])->render());
        $mpdf->Output(storage_path('app/docs/').str_replace('/', '_', $invoice->invoice_number).'.pdf', 'F');
    }

    public static function generateBillPdf($billId){
        $bill = Bill::find($billId);
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

        $mpdf = Helper::initMpdf();
        $mpdf->WriteHTML(file_get_contents(public_path().'/css/invoice.css'), 1);
        $mpdf->WriteHTML(view('bill.generate-pdf', ['bill' => $bill, 'owner' => $owner])->render());
        $mpdf->Output(storage_path('app/docs/').str_replace('/', '_', $bill->bill_number).'.pdf', 'F');
    }

    public static function generateContract($template, $contract, $request, $owner){
        $mpdf = Helper::initMpdf();
        $mpdf->WriteHTML('<style>'.file_get_contents(public_path().'/css/contractpdf.css').'</style>', 1);
        $mpdf->WriteHTML(view('contract.templates.'.$template, ['contract' => $contract, 'request' => $request, 'owner' => $owner])->render());
        $mpdf->Output(storage_path('app/docs/').$contract->slug.'.pdf', 'F');
    }
}
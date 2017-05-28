<?php

namespace App\Libraries;

use App\Invoice;
use App\Owner;
use App\Libraries\Helper;
use Carbon\Carbon;
use mPDF;

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

        if(!defined('_MPDF_TTFONTPATH')){
            define('_MPDF_TTFONTPATH', public_path().'/fonts/ttfonts/');
        }
        $mpdf = new mPDF;
        Helper::addCustomFontsToMpdf($mpdf);
        $mpdf->WriteHTML(file_get_contents(public_path().'/css/invoice.css'), 1);
        $mpdf->WriteHTML(view('invoice.generate-pdf', ['invoice' => $invoice, 'owner' => $owner])->render());
        $mpdf->Output(storage_path('app/docs/').str_replace('/', '_', $invoice->invoice_number).'.pdf', 'F');
    }
}
<?php

namespace App\Libraries;

use App\Client;
use App\Invoice;
use App\InvoicePosition;
use App\Invitation;
use App\Hosting;
use App\HostingCycle;
use App\PaymentMethod;
use App\Mail\Invite;
use App\Mail\HostingEnds;
use App\Libraries\Generator;
use Carbon\Carbon;
use Mail;

class Helper{
    public static function addCustomFontsToMpdf(&$mpdf){
        $fontdata = [
            'raleway' => [
                'R' => 'Raleway-Bold.ttf',
                'B' => 'Raleway-Regular.ttf',
            ],
            'opensans' => [
                'R' => 'OpenSans-Regular.ttf',
                'SB' => 'OpenSans-Semibold.ttf',
                'B' => 'OpenSans-Bold.ttf',
            ],
        ];

        foreach($fontdata as $f => $fs){
            // add to fontdata array
            $mpdf->fontdata[$f] = $fs;

            // add to available fonts array
            foreach(['R', 'B', 'I', 'BI'] as $style){
                if(isset($fs[$style]) && $fs[$style]){
                    // warning: no suffix for regular style! hours wasted: 2
                    $mpdf->available_unifonts[] = $f . trim($style, 'R');
                }
            }
        }

        $mpdf->default_available_fonts = $mpdf->available_unifonts;
    }

    public static function initMpdf($format = 'A4'){
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => $format,
            'fontDir' => array_merge($fontDirs, [public_path('fonts/ttfonts')]),
            'fontdata' => $fontData + [
                'raleway' => [
                    'R' => 'Raleway-Bold.ttf',
                    'B' => 'Raleway-Regular.ttf',
                ],
                'opensans' => [
                    'R' => 'OpenSans-Regular.ttf',
                    'SB' => 'OpenSans-Semibold.ttf',
                    'B' => 'OpenSans-Bold.ttf',
                ],
            ],
        ]);

        return $mpdf;
    }

    public static function getCompanies(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://firmy.zencore.pl/api/get-companies');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "auth_key=CXuemutDtr4o4spyvjmLJPbphZyzdbCf&start_date=".Carbon::now()->subMonths(3)->format('Y-m-d'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $companies = json_decode($output);
        foreach($companies as $company){
            if(Invitation::where('email', $company->email)->first() == null){
                $invitation = new Invitation;
                $invitation->firstname = $company->firstname;
                $invitation->lastname = $company->lastname;
                $invitation->company_name = $company->company_name;
                $invitation->email = $company->email;
                $invitation->save();
            }
        }
        curl_close($ch);
    }

    public static function sendInvitations(){
        $invitations = Invitation::where('sent', 0)->limit(10)->get();
        foreach($invitations as $invitaton){
            Mail::to($invitaton->email)->send(new Invite($invitaton));
            $invitaton->sent = 1;
            $invitaton->save();
        }
    }

    public static function generateRandomString($length = 10, $set = 'nlu'){
        switch($set){
            case 'n':
                $characters = '0123456789';
                break;
            case 'l':
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                break;
            case 'u':
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'nl':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                break;
            case 'nu':
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'lu':
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'nlu':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }

        $charactersLength = strlen($characters);
        $randomString = '';

        for($i = 0; $i < $length; $i++){
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function hostingEnds(){
        $now = Carbon::now();
        $twoWeeks = $now->addWeeks(2);

        $hostingCycles = HostingCycle::where([
            ['end_date', '>=', $twoWeeks->format('Y-m-d 00:00:00')],
            ['end_date', '<=', $twoWeeks->format('Y-m-d 23:59:59')],
            ['paid', '=', true]
        ])->get();

        foreach($hostingCycles as $hostingCycle){
            if(HostingCycle::where([['start_date', '=', $hostingCycle->end_date], ['hosting_id', '=', $hostingCycle->hosting_id]])->first() == null){
                $hosting = Hosting::find($hostingCycle->hosting_id);
                if($hosting->finishing == false){
                    $hostingCycleNew = new HostingCycle;
                    $hostingCycleNew->hosting_id = $hostingCycle->hosting_id;
                    $hostingCycleNew->start_date = $hostingCycle->end_date;
                    $periodStart = Carbon::createFromFormat('Y-m-d H:i:s', $hostingCycleNew->start_date);
                    switch($hostingCycle->period){
                      case 1:
                        $periodEnd = $periodStart->addDays($hostingCycle->period_count);
                        break;
                      case 2:
                        $periodEnd = $periodStart->addWeeks($hostingCycle->period_count);
                        break;
                      case 3:
                        $periodEnd = $periodStart->addMonths($hostingCycle->period_count);
                        break;
                      case 4:
                        $periodEnd = $periodStart->addYears($hostingCycle->period_count);
                        break;
                    }
                    $hostingCycleNew->end_date = $periodEnd;
                    $hostingCycleNew->period_count = $hostingCycle->period_count;
                    $hostingCycleNew->period = $hostingCycle->period;
                    $hostingCycleNew->paid = false;
                    $hostingCycleNew->price_tax_excl = $hostingCycle->price_tax_excl;
                    $hostingCycleNew->save();

                    $invoice = new Invoice;
                    $invoice->client_id = $hosting->client_id;
                    $invoice->address_id = Client::find($hosting->client_id)->addresses()->first()->id;
                    $issueDate = Carbon::now();
                    $invoicesCount = Invoice::where([
                        ['issue_date', '>=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-1')],
                        ['issue_date', '<=', Carbon::createFromFormat('Y-m', $issueDate->format('Y-m'))->format('Y-m-31')],
                        ['advance', '=', false],
                        ['proforma', '=', true],
                    ])->count();
                    $invoice->invoice_number = 'PRO/'.$issueDate->format('Y/m').'/'.(($invoicesCount + 1) < 10 ? '0'.($invoicesCount + 1) : $invoicesCount + 1);
                    $invoice->issue_city = 'Łódź';
                    $invoice->issue_date = Carbon::now()->format('Y-m-d H:i:s');
                    $invoice->payment_date = Carbon::now()->addWeeks(2)->format('Y-m-d H:i:s');
                    $invoice->advance = false;
                    $invoice->proforma = true;
                    $invoice->payment_method_id = PaymentMethod::where('module_name', 'bank_transfer')->first()->id;
                    $invoice->paid = false;
                    $invoice->save();

                    $invoicePositionName = 'Hosting';
                    $invoicePositionName .= ' ('.$hostingCycleNew->period_count.' ';
                    switch($hostingCycleNew->period){
                        case 1:
                            $invoicePositionName .= ($hostingCycleNew->period_count <= 1 ? 'dzień' : 'dni');
                            break;
                        case 2:
                            $invoicePositionName .= ($hostingCycleNew->period_count <= 1 ? 'tydzień' : 'tygodni');
                            break;
                        case 3:
                            $invoicePositionName .= ($hostingCycleNew->period_count <= 1 ? 'miesiąc' : 'miesięcy');
                            break;
                        case 4:
                            $invoicePositionName .= ($hostingCycleNew->period_count <= 1 ? 'rok' : 'lat');
                            break;
                    }
                    $invoicePositionName .= ')';

                    $invoicePosition = new InvoicePosition;
                    $invoicePosition->invoice_id = $invoice->id;
                    $invoicePosition->name = $invoicePositionName;
                    $invoicePosition->quantity = 1;
                    $invoicePosition->measure_unit = 'szt';
                    $invoicePosition->price_tax_excl = $hostingCycleNew->price_tax_excl;
                    $invoicePosition->tax_id = 1;
                    $invoicePosition->save();

                    Generator::generateInvoicePdf($invoice->id);

                    Mail::to('admin@zencore.pl')->send(new HostingEndsNotification($hosting, $hostingCycle, $hostingCycleNew, $invoice));
                }
            }
        }
    }
}

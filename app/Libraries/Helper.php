<?php

namespace App\Libraries;

use App\Invitation;
use App\Mail\Invite;
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

    public static function getCompanies(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://firmy.zencore.pl/api/get-companies');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "auth_key=CXuemutDtr4o4spyvjmLJPbphZyzdbCf&start_date=".Carbon::now()->subDay()->format('Y-m-d'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $companies = json_decode($output);
        foreach($companies as $company){
            $invitation = new Invitation;
            $invitation->firstname = $company->firstname;
            $invitation->lastname = $company->lastname;
            $invitation->company_name = $company->company_name;
            $invitation->email = $company->email;
            $invitation->save();
        }
        curl_close($ch);
    }

    public static function sendInvitations(){
        $invitations = Invitation::where('sent', 0)->get();
        foreach($invitations as $invitaton){
            Mail::to($invitaton->email)->send(new Invite($invitaton));
            $invitaton->sent = 1;
            $invitaton->save();
        }
    }
}

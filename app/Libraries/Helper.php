<?php

namespace App\Libraries;

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
}
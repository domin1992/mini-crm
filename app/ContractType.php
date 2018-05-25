<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    public function fieldsTextToArray($fields){
        $lines = explode("\r\n", $fields);
        $fieldsArray = [];
        foreach($lines as $line){
            list($name, $placeholder, $type, $validation) = explode(';', $line);
            $fieldsArray[] = [
                'name' => $name,
                'placeholder' => $placeholder,
                'type' => $type,
                'validation' => $validation,
            ];
        }
        return $fieldsArray;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function client(){
        return $this->belongsTo('App\Client', 'client_id', 'id');
    }

    public function signMethod(){
        return $this->belongsTo('App\ContractSignMethod', 'contract_sign_method_id', 'id');
    }

    public function type(){
        return $this->belongsTo('App\ContractType', 'contract_type_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'client_id', 'address_id', 'bill_number', 'issue_city', 'issue_date', 'sell_date', 'payment_method'
    ];

    public function billPositions(){
        return $this->hasMany('App\BillPosition');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function paymentMethod(){
        return $this->belongsTo('App\PaymentMethod');
    }
}

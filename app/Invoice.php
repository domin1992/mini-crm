<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_id', 'address_id', 'invoice_number', 'issue_city', 'issue_date', 'issue_name', 'payment_date', 'payment_method', 'advance', 'comment'
    ];

    public function invoicePositions(){
        return $this->hasMany('App\InvoicePosition');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }
}

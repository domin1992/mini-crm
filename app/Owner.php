<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
      'name', 'vat_number', 'nbrn', 'email', 'phone', 'website', 'postcode', 'city', 'street', 'country', 'bank_name', 'bank_account_number'
    ];
}

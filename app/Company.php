<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
      'name', 'vat_number', 'nbrn', 'email', 'phone', 'website', 'address', 'postcode', 'city', 'street', 'status', 'pkd_codes'
    ];

}

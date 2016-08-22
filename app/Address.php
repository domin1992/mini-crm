<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected $fillable = [
    'client_id', 'name', 'street', 'street_number', 'appartment_number', 'city', 'postcode', 'country', 'other'
  ];
}

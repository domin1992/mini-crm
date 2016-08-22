<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $fillable = [
    'client_id', 'firstname', 'lastname', 'title', 'email', 'phone'
  ];
}

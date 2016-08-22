<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $fillable = [
    'company', 'nip', 'email'
  ];

  public function addresses(){
    return $this->hasMany('App\Address');
  }

  public function contacts(){
    return $this->hasMany('App\Contact');
  }
}

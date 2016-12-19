<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecurringPayment extends Model
{
  protected $fillable = [
    'client_id', 'name', 'description', 'period_count', 'period', 'period_start', 'price'
  ];

  public function client(){
    return $this->belongsTo('App\Client');
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicePosition extends Model
{
  protected $fillable = [
    'invoice_id', 'name', 'symbol_pkwiu', 'measure_unit', 'quantity', 'price_tax_excl', 'tax_id'
  ];

  public function tax(){
    return $this->belongsTo('App\Tax');
  }
}

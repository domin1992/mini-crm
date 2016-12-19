<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyComment extends Model
{
  protected $fillable = [
    'company_id', 'client_id', 'comment'
  ];

  public function company(){
    return $this->belongsTo('App\Company');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }
}

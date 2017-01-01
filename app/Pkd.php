<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pkd extends Model
{
  protected $table = 'pkds';

  protected $fillable = [
    'pkd_id', 'level_id', 'symbol', 'symbol_rewrite', 'name', 'description'
  ];
}

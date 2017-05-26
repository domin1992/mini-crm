<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillPosition extends Model
{
    public function tax(){
        return $this->belongsTo('App\Tax');
    }
}

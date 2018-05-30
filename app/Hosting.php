<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hosting extends Model
{
    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function cycle(){
        return $this->hasMany('App\HostingCycle');
    }
}

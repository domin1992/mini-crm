<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mileage extends Model
{
    public function records(){
        return $this->hasMany('App\MileageRecord');
    }
}

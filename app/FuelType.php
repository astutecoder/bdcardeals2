<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    public function cars(){
        return $this->belongsToMany('App\Car', 'cars_fuel_types', 'fuel_types_id', 'cars_id');
    }
}

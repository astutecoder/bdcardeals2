<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public function cars()
    {
        return $this->belongsToMany('App\Car', 'cars_colors', 'colors_id','cars_id');
    }
}

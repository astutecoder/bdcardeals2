<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function cars(){
        return $this->hasMany('App\Car', 'source_id');
    }
}

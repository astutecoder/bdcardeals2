<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyType extends Model
{
    public function cars() {
        return $this->hasMany('App\Car', 'body_types_id');
    }
}

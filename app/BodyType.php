<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyType extends Model
{
    public function cars() {
        return $this->hasMany('Cars', 'body_types_id');
    }
}

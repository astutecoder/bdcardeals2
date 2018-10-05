<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {

    public function cars()
    {
        return $this->belongsTo('App\Car', 'cars_id');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo', 'album_id');
    }
}

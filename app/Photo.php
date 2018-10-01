<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function cars(){
        return $this->belongsTo('App\Car', 'cars_id');
    }
    public function albums(){
        return $this->belongsTo('App\Album', 'album_id');
    }
}

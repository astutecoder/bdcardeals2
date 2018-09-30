<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function sources()
    {
        return $this->belongsTo('App\Source', 'source_id');
    }

    public function brands()
    {
        return $this->belongsTo('App\Brand', 'brands_id');
    }

    public function body_types()
    {
        return $this->belongsTo('App\BodyType', 'body_types_id');
    }

    public function fuel_types()
    {
        return $this->belongsToMany('App\FuelType', 'cars_fuel_types', 'cars_id', 'fuel_types_id');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Color', 'cars_colors', 'cars_id', 'colors_id');
    }
}

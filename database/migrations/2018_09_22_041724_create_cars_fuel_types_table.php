<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsFuelTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_fuel_types', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('cars_id')->unsigned();
            $table->foreign('cars_id')->references('id')->on('cars');

            $table->integer('fuel_types_id')->unsigned();
            $table->foreign('fuel_types_id')->references('id')->on('fuel_types');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars_fuel_types');
    }
}

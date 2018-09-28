<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_colors', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cars_id')->unsigned();
            $table->foreign('cars_id')->references('id')->on('cars');

            $table->integer('colors_id')->unsigned();
            $table->foreign('colors_id')->references('id')->on('colors');

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
        Schema::dropIfExists('cars_colors');
    }
}

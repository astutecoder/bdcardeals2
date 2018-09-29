<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', '255')->nullable();
            $table->string('subtitle', '255')->nullable();
            $table->string('model_no', '255');
            $table->string('year', '45');
            $table->string('engine', '150')->comment('eg: 5.7L V8')->nullable();
            $table->string('transmission', '150')->comment('eg: AUTO 8-SPEED')->nullable();
            $table->string('mileage', '150')->comment('eg: 20,300MI')->nullable();
            $table->string('doors', '45')->comment('eg: 4/5')->nullable();
            $table->text('features')->nullable();
            $table->text('safety')->nullable();
            $table->text('comfort')->nullable();
            $table->integer('price');
            $table->integer('offer_price')->nullable();
            $table->integer('is_negotiable_price')->default('0')->comment('1=yes, 0=no');
            $table->integer('is_featured')->default('0')->comment('1=yes, 0=no');

            $table->integer('brands_id')->unsigned();
            $table->foreign('brands_id')->references('id')->on('brands')->onDelete('cascade');

            $table->integer('body_types_id')->unsigned();
            $table->foreign('body_types_id')->references('id')->on('body_types')->onDelete('cascade');

            $table->integer('save_complete')->default('0')->comment('1=yes, 0=no');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}

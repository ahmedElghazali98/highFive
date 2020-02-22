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
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->integer('type_id');
            $table->integer('color_id');
            $table->integer('driver_id');
            $table->string('number');
            $table->integer('manufacturing_year');
            $table->Integer('user_id');
            $table->Integer('company_id');
            $table->Integer('serial');

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
        Schema::dropIfExists('cars');
    }
}

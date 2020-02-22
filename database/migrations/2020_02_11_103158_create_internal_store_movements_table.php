<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalStoreMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_store_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('from_store_id');
            $table->integer('to_store_id');
            $table->integer('car_id');
            $table->date('date');
            $table->integer('emp_id');
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
        Schema::dropIfExists('internal_store_movements');
    }
}

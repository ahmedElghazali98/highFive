<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalStoreMovementLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_store_movement_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('from_store_id');
            $table->Integer('to_store_id');
            $table->Integer('item_id');
            $table->Integer('movement_id');
            $table->Integer('car_id');
            $table->Integer('emp_id');
            $table->double('quantity');
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
        Schema::dropIfExists('internal_store_movement_logs');
    }
}

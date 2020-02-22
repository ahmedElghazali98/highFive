<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemProductionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_production_logs', function (Blueprint $table) {
            $table->Increments('id');
            $table->Integer('item_production_id');
            $table->Integer('item_id');
            $table->Integer('store_id');
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
        Schema::dropIfExists('item_production_logs');
    }
}

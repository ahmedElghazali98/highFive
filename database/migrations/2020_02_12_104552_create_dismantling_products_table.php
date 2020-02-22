<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDismantlingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dismantling_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id');
            $table->integer('to_store_id');
            $table->date('date');
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
        Schema::dropIfExists('dismantling_products');
    }
}

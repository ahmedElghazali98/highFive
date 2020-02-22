<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_productions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id');
            $table->integer('store_id');
            $table->integer('quantity');
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
        Schema::dropIfExists('items_productions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategotiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('manufacture_company_id');
            $table->integer('unit_id');
            $table->integer('size_id');
            $table->string('link_img');
            $table->integer('type_category_id');
            $table->integer('minimum');
            $table->integer('pricing_price');
            $table->integer('final_price');
            $table->integer('wholesale_price');
            $table->integer('cost_price');
            $table->string('barcode');
            $table->Integer('category_product_id');
            $table->Integer('tax_id');
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
        Schema::dropIfExists('categoties');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubltemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subltems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('items_id');
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
        Schema::dropIfExists('subltems');
    }
}

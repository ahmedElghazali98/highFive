<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessorsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processors_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filed_ar');
            $table->string('old_value');
            $table->string('new_value');
            $table->integer('movemoent_id');
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
        Schema::dropIfExists('processors_logs');
    }
}

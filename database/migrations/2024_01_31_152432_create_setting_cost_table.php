<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_cost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('setting_hour_id');
            $table->double('cost', 8, 2);
            $table->integer('start_hour')->nullable();
            $table->integer('end_hour')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('setting_hour_id')->references('id')->on('setting_hour')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_cost');
    }
}

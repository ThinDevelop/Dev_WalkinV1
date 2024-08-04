<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingVechicleStampTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_vechicle_stamp_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vechicle_cost_type_id')->nullable();
            $table->foreign('vechicle_cost_type_id')->references('id')->on('vechicle_cost_type');
            $table->unsignedBigInteger('stamp_type_id')->nullable();
            $table->foreign('stamp_type_id')->references('id')->on('stamp_type');
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
        Schema::dropIfExists('setting_vechicle_stamp_type');
    }
}

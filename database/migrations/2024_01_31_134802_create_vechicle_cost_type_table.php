<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVechicleCostTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vechicle_cost_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->comment('1 รายวัน, 2 รายชั่วโมง');
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
        Schema::dropIfExists('vechicle_cost_type');
    }
}

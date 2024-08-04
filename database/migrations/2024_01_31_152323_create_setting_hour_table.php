<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingHourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_hour', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('vechicle_cost_types_id')->nullable();
            $table->string('name_place', 255);
            $table->smallInteger('status')->comment('0 ไม่ใช้งาน, 1 ใช้งาน');
            $table->double('cost', 8, 2)->nullable();
            $table->smallInteger('status_stamp')->comment('1 ละเว้นทั้งหมด, 2 กำหนดชั่วโมง');
            $table->unsignedBigInteger('stamp_type')->comment('0 ไม่ใช้งาน stamp, 1 ใช้งาน stamp');
            $table->integer('num_hour')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('vechicle_cost_types_id')->references('id')->on('vechicle_cost_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_hour');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->comment('1 รออนุมัติ, 2 อนุมัติ, 3 ไม่อนุมัติ, 4 ยกเลิก');
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
        Schema::dropIfExists('appointment_status');
    }
}

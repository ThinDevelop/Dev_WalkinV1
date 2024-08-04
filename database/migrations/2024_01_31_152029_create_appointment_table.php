<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from', 191);
            $table->string('name', 100);
            $table->string('lastname', 100);
            $table->string('phone', 30);
            $table->string('email', 30);
            $table->date('date_appointment');
            $table->integer('start_time');
            $table->integer('end_time');
            $table->string('note', 255);
            $table->string('appointment_code', 30);
            $table->timestamps();
            $table->unsignedBigInteger('pdpa_id');
            $table->unsignedBigInteger('pdpa_status_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('objective_id');
            $table->unsignedBigInteger('status')->comment('1 รออนุมัติ, 2 อนุมัติ, 3 ไม่อนุมัติ, 4 ยกเลิก');

            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('objective_id')->references('id')->on('objective_type');
            $table->foreign('status')->references('id')->on('appointment_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment');
    }
}

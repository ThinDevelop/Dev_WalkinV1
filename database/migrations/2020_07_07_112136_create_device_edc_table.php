<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceEdcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_edc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial_number');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('type')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('company_id')
            ->references('id')
            ->on('company')
            ->onDelete('SET NULL');

            $table->foreign('type')
            ->references('id')
            ->on('device_type')
            ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_edc');
    }
}

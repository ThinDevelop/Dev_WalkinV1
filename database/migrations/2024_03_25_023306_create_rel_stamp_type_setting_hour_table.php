<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelStampTypeSettingHourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_stamp_type_setting_hour', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('setting_hour_id')->nullable();
            $table->foreign('setting_hour_id')->references('id')->on('setting_hour')->onDelete('cascade');
            $table->unsignedBigInteger('stamp_type_id')->nullable();
            $table->foreign('stamp_type_id')->references('id')->on('stamp_type');
            $table->integer('num_hour')->nullable();
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
        Schema::dropIfExists('rel_stamp_type_setting_hour');
    }
}

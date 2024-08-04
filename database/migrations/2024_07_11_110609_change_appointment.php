<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAppointment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->change();
            $table->string('from', 191)->nullable()->change();
            $table->string('note', 255)->nullable()->change();
            $table->unsignedBigInteger('pdpa_id')->nullable()->change();
            $table->unsignedBigInteger('pdpa_status_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->change();
            $table->string('from', 191)->change();
            $table->string('note', 255)->change();
            $table->unsignedBigInteger('pdpa_id')->change();
            $table->unsignedBigInteger('pdpa_status_id')->change();
        });
    }
}

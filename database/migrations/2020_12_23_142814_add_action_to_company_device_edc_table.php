<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActionToCompanyDeviceEdcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_device_edc', function (Blueprint $table) {
           
            $table->bigInteger('company_id')->unsigned()->change();
            $table->bigInteger('edc_id')->unsigned()->change();

            $table->tinyInteger('action')->after('edc_id')->comment('1=add on;2=delete');

            $table->foreign('company_id')
            ->references('id')
            ->on('company');

            $table->foreign('edc_id')
            ->references('id')
            ->on('device_edc');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_device_edc', function (Blueprint $table) {
            //
        });
    }
}

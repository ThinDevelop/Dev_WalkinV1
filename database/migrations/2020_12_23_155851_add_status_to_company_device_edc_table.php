<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCompanyDeviceEdcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_device_edc', function (Blueprint $table)
        {
            $table->tinyInteger('device_status')->after('action')->comment('1=demo;2=เช่า;3=ขาย;4=ซ่อม;5=เรียกเก็บ');
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

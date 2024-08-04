<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DroupCompanyToCompanyDeviceEdcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_device_edc', function (Blueprint $table) {
            //

            $table->dropForeign(['company_id']);


            $table->dropColumn('company_id');
            $table->bigInteger('company_parent_id')->unsigned()->nullable()->after('id');

            $table->foreign('company_parent_id')
            ->references('id')
            ->on('company_parent')
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
        Schema::table('company_device_edc', function (Blueprint $table) {
            //
        });
    }
}

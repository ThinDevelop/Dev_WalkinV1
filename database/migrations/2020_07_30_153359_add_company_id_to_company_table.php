<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->bigInteger('company_parent_id')->unsigned()->nullable()->after('note');

            $table->foreign('company_parent_id')
            ->references('id')
            ->on('company_parent')
            ->onDelete('SET NULL');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('company_parent_id')->unsigned()->nullable()->after('last_login_ip');

            $table->foreign('company_parent_id')
            ->references('id')
            ->on('company_parent')
            ->onDelete('SET NULL');
        });

        Schema::table('device_edc', function (Blueprint $table) {
            $table->bigInteger('company_parent_id')->unsigned()->nullable()->after('serial_number');

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
        Schema::table('company', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommanToCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            //

            $table->bigInteger('status')->default(1)->comment('0 ไม่ใช้งาน, 1 ใช้งาน')->change();
        });

        Schema::table('company_parent', function (Blueprint $table) {
            //
            $table->bigInteger('status')->default(1)->comment('0 ไม่ใช้งาน, 1 ใช้งาน')->change();
        });

        Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('status')->default(1)->comment('0 ไม่ใช้งาน, 1 ใช้งาน')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

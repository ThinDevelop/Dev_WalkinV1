<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dateTime('last_login_at')->nullable()->after('remember_token');
            $table->ipAddress('last_login_ip')->nullable()->after('last_login_at');
            $table->bigInteger('company_id')->unsigned()->nullable()->after('id')->after('last_login_ip');

            $table->foreign('company_id')
            ->references('id')
            ->on('company')
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

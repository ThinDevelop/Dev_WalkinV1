<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBlacklist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blacklist', function (Blueprint $table) {
            $table->bigInteger('status')->default(0)->comment('0 ผู้เคยถูกแบล็กลิสต์, 1 ผู้ถูกแบล็กลิสต์')->after('from');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blacklist', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

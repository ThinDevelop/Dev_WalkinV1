<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeImageBlacklist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_blacklist', function (Blueprint $table) {
            $table->string('image_url', 100)->after('id')->nullable();
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_blacklist', function (Blueprint $table) {
            $table->string('name', 30)->after('id')->nullable();
            $table->dropColumn('image_url');
        });
    }
}

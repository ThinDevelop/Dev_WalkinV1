<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBlacklist2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blacklist', function (Blueprint $table) {
            $table->foreign('image_blacklist_id')->references('id')->on('image_blacklist')->onDelete('cascade');
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
            $table->dropForeign(['image_blacklist_id']);
        });
    }
}

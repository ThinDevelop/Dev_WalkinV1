<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBlacklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blacklist', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_transaction_id')->nullable()->change();
            $table->unsignedBigInteger('image_type')->nullable()->change();
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
            $table->unsignedBigInteger('contact_transaction_id')->nullable(false)->change();
            $table->unsignedBigInteger('image_type')->nullable(false)->change();
        });
    }
}

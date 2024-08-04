<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPdpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pdpa', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('company')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_vechicle', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('company');
        });
    }
}

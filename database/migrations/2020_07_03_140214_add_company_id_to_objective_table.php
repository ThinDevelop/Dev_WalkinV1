<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToObjectiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objective_type', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable()->after('id');

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
        Schema::table('objective_type', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSortingInObjectiveTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objective_type', function (Blueprint $table) {
            $table->smallInteger('sorting');
            $table->smallInteger('status')->default(1)->comment('0 ไม่ใช้งาน, 1 ใช้งาน');
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

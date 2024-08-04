<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnContactTransection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_transection', function (Blueprint $table) {
            $table->unsignedBigInteger('vechicle_cost_types_id')->nullable();
            $table->foreign('vechicle_cost_types_id')->references('id')->on('vechicle_cost_type');
            $table->unsignedBigInteger('stamp_type_id')->nullable();
            $table->foreign('stamp_type_id')->references('id')->on('stamp_type');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

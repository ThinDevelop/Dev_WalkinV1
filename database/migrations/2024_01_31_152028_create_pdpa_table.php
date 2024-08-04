<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdpa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('pdpa');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('company_id');

            $table->foreign('company_id')->references('id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdpa');
    }
}

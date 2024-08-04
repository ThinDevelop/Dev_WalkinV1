<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlacklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blacklist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname', 30);
            $table->string('note', 255);
            $table->timestamps();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('contact_transaction_id');
            $table->unsignedBigInteger('image_type');

            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('contact_transaction_id')->references('id')->on('contact_transection');
            $table->foreign('image_type')->references('id')->on('image_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blacklist');
    }
}

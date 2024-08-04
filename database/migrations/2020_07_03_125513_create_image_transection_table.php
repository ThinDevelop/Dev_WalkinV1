<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTransectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_transection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_id')->unsigned()->nullable();
            $table->bigInteger('image_type_id')->unsigned()->nullable();
            $table->string('image_url',100);
            $table->timestamps();

            $table->foreign('image_type_id')
            ->references('id')
            ->on('image_type')
            ->onDelete('SET NULL');

            $table->foreign('contact_id')
            ->references('id')
            ->on('contact_transection')
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
        Schema::dropIfExists('image_transection');
    }
}

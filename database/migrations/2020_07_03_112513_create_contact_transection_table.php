<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTransectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_transection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->bigInteger('objective_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('contact_code',30);
            $table->string('idcard',30);
            $table->string('fullname');
            $table->dateTime('checkin_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('checkout_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('status')->default(0)->comment('0 เข้า, 1 ออก');
            $table->timestamps();

            $table->foreign('company_id')
            ->references('id')
            ->on('company')
            ->onDelete('SET NULL');

            $table->foreign('department_id')
            ->references('id')
            ->on('departments')
            ->onDelete('SET NULL');

            $table->foreign('objective_id')
            ->references('id')
            ->on('objective_type')
            ->onDelete('SET NULL');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('contact_transection');
    }
}

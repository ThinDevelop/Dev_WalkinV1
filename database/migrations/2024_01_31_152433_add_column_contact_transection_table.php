<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnContactTransectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_transection', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->after('status')->nullable();
            $table->double('price_discount', 8 ,2)->after('status')->nullable();
            $table->double('price_amount', 8, 2)->after('status')->nullable();
            $table->double('price', 8, 2)->after('status')->nullable();
            
            $table->unsignedBigInteger('pdpa_id')->after('user_id')->nullable();
            $table->unsignedBigInteger('status_pdpa_id')->after('user_id')->nullable();

            $table->foreign('payment_id')->references('id')->on('payment');
            $table->foreign('pdpa_id')->references('id')->on('pdpa');
            $table->foreign('status_pdpa_id')->references('id')->on('pdpa_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('contact_transection');
    }
}

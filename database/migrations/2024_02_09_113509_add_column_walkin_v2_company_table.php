<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWalkinV2CompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->string('promptpay', 30)->nullable()->after('logo');
            $table->string('line_token', 255)->nullable()->after('logo');
            $table->smallInteger('status_vechicle')->default(0)->comment('ที่จอดรถ 0 = ไม่ใช้งาน, 1= ใช้งาน');
            $table->unsignedBigInteger('contract_vechicle_id')->nullable();
            $table->foreign('contract_vechicle_id')->references('id')->on('contract_vechicle');
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

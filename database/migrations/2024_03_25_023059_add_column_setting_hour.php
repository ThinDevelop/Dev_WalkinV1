<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSettingHour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_hour', function (Blueprint $table) {
            $table->unsignedBigInteger('setting_parking_company_id')->after('vechicle_cost_types_id')->nullable();
            $table->foreign('setting_parking_company_id')->references('id')->on('setting_parking_company')->onDelete('cascade');
            $table->smallInteger('status_stamp')->default(1)->comment('0 ไม่ใช้งาน stamp, 1 ใช้งาน stamp')->change();
            if (Schema::hasColumn('setting_hour', 'stamp_type')) {
                $table->dropColumn('stamp_type');
            }
            if (Schema::hasColumn('setting_hour', 'name_place')) {
                $table->dropColumn('name_place');
            }
            if (Schema::hasColumn('setting_hour', 'num_hour')) {
                $table->dropColumn('num_hour');
            }
            if (Schema::hasColumn('setting_hour', 'company_id')) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            }
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

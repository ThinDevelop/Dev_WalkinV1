<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnContactTransection2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_transection', function (Blueprint $table) {
            // เพิ่มคอลัมน์ appointment_id และกำหนดให้สามารถเป็น NULL ได้
            $table->unsignedBigInteger('appointment_id')->nullable()->after('pdpa_id');

            // สร้าง foreign key constraint เพื่อเชื่อมโยงกับตาราง appointment
            $table->foreign('appointment_id')
                  ->references('id')
                  ->on('appointment')
                  ->onDelete('cascade'); // ตั้งค่าการลบ cascade (optional)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_transection', function (Blueprint $table) {
            // ลบ foreign key constraint
            $table->dropForeign(['appointment_id']);
            
            // ลบคอลัมน์ appointment_id
            $table->dropColumn('appointment_id');
        });
    }
}

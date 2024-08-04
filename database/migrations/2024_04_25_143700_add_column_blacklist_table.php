<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBlacklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blacklist', function (Blueprint $table) {
            $table->string('from')->nullable()->after('image_type');
            $table->string('car_registration', 30)->after('image_type');
            $table->text('address')->nullable()->default(null)->after('image_type');
            $table->unsignedBigInteger('image_blacklist_id')->nullable()->after('image_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blacklist', function (Blueprint $table) {
            $table->dropColumn('from');
            $table->dropColumn('car_registration');
            $table->dropColumn('address');
            $table->dropColumn('image_blacklist_id');
        });
    }
}

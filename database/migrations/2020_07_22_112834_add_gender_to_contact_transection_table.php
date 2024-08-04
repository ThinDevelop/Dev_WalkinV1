<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToContactTransectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_transection', function (Blueprint $table) {
            //
            $table->string('gender')->nullable()->default(NULL)->after('fullname');	
            $table->date('birth_date')->nullable()->default(NULL)->after('gender');
            $table->text('address')->nullable()->default(NULL)->after('birth_date');	
            
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
            //
        });
    }
}

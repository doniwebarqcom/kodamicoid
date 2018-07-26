<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('date_active')->nullable();
            $table->dateTime('date_inactive')->nullable();
            $table->string('npwp_number', 100)->nullable();
            $table->string('passport_number', 100)->nullable();
            $table->string('kk_number')->nullable();
            $table->string('bpjs_number')->nullable();
            $table->text('file_npwp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

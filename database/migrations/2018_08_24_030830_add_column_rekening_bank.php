<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRekeningBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening_bank', function (Blueprint $table) {
            $table->string('owner', 150)->nullable();
            $table->string('moota_bank_id', 150)->nullable();
            $table->smallInteger('is_active')->nullable();
            $table->dateTime('last_update')->nullable();
            $table->string('username')->nullable();
            $table->string('bank_code', 100)->nullable();
            $table->smallInteger('is_favorit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rekening_bank', function (Blueprint $table) {
            //
        });
    }
}

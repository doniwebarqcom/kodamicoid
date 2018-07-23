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
            $table->integer('domisili_provinsi_id')->nullable();
            $table->integer('domisili_kabupaten_id')->nullable();
            $table->integer('domisili_kecamatan_id')->nullable();
            $table->text('domisili_alamat')->nullable();

            $table->integer('ktp_provinsi_id')->nullable();
            $table->integer('ktp_kabupaten_id')->nullable();
            $table->integer('ktp_kecamatan_id')->nullable();
            $table->text('ktp_alamat')->nullable();

            $table->smallInteger('durasi_pembayaran')->nullable();
            $table->integer('first_simpanan_sukarela')->nullable();
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

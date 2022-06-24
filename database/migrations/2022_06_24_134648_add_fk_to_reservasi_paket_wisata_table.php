<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToReservasiPaketWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservasi_paket_wisata', function (Blueprint $table) {
            //
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_paket_wisata')->references('id')->on('paket');
            $table->foreign('id_rekening')->references('id')->on('rekening');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservasi_paket_wisata', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalVerifikasiToReservasiPaketWisataTable extends Migration
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
            $table->date('tgl_verifikasi')->after('bukti_reservasi')->nullable();
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
            $table->dropColumn('tgl_verifikasi');
        });
    }
}

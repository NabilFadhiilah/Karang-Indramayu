<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiPaketWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi_paket_wisata', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_paket_wisata');
            $table->integer('id_rekening');
            $table->integer('partisipan_reservasi');
            $table->date('tgl_reservasi');
            $table->date('tgl_pesan_reservasi');
            $table->date('tgl_batas_pembayaran');
            $table->string('bukti_reservasi')->nullable();
            $table->string('status_reservasi')->default('PENDING');
            $table->string('total_reservasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi_paket_wisata');
    }
}

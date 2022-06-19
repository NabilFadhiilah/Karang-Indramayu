<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi_wisata', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();;
            $table->bigInteger('id_wisata')->unsigned();
            $table->bigInteger('id_rekening')->unsigned();
            $table->integer('partisipan_reservasi');
            $table->date('tgl_reservasi');
            $table->date('tgl_pesan_reservasi');
            $table->dateTime('tgl_batas_pembayaran');
            $table->string('bukti_reservasi')->nullable();
            $table->date('tgl_verifikasi')->nullable();
            $table->string('status_reservasi')->default('PENDING');
            $table->string('total_reservasi');
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_wisata')->references('id')->on('wisata');
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
        Schema::dropIfExists('reservasi_wisata');
    }
}

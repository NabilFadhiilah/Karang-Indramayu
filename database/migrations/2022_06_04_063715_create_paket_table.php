<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('slug');
            $table->string('durasi_wisata');
            $table->string('deskripsi');
            $table->bigInteger('harga');
            $table->string('ketentuan');
            $table->date('tgl_reservasi_awal');
            $table->date('tgl_reservasi_akhir');
            $table->boolean('status_wisata');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket');
    }
}

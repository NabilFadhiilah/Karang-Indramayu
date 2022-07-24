<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->string('slug');
            $table->text('deskripsi');
            $table->string('durasi_wisata');
            $table->bigInteger('harga');
            $table->text('ketentuan');
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
        Schema::dropIfExists('wisata');
    }
}

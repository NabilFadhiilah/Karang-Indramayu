<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lap_wisata', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_reservasi_wisata')->unsigned();
            $table->string('pengeluaran');
            $table->bigInteger('biaya_pengeluaran');
            $table->timestamps();
            $table->foreign('id_reservasi_wisata')->references('id')->on('reservasi_wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lap_wisata');
    }
}

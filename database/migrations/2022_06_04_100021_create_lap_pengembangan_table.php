<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapPengembanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lap_pengembangan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pengembangan')->unsigned();
            $table->string('pengeluaran');
            $table->bigInteger('biaya_pengeluaran');
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
        Schema::dropIfExists('lap_pengembangan');
    }
}

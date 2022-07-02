<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToLapPengembanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lap_pengembangan', function (Blueprint $table) {
            //
            $table->foreign('id_pengembangan')->references('id')->on('pengembangan_wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lap_pengembangan', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKetPengeluaranToLapPengembanganTable extends Migration
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
            $table->string('ket_pengeluaran')->after('tgl_pengeluaran');
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
            $table->dropColumn('ket_pengeluaran');
        });
    }
}

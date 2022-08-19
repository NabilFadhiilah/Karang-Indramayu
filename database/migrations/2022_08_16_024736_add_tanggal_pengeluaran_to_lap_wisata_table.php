<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalPengeluaranToLapWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lap_wisata', function (Blueprint $table) {
            //
            $table->date('tgl_pengeluaran')->after('biaya_pengeluaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lap_wisata', function (Blueprint $table) {
            //
            $table->dropColumn('tgl_pengeluaran');
        });
    }
}

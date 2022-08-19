<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKetPengeluaranToLapWisataTable extends Migration
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
        Schema::table('lap_wisata', function (Blueprint $table) {
            //
            $table->dropColumn('ket_pengeluaran');
        });
    }
}

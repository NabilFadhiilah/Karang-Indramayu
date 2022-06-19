<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColomnsToPengembanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengembangan', function (Blueprint $table) {
            //
            $table->string('bukti_pembayaran')->after('pendanaan')->nullable();
            $table->date('tgl_investasi')->after('bukti_pembayaran');
            $table->dateTime('tgl_batas_pembayaran')->after('tgl_investasi');
            $table->date('tgl_verifikasi')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengembangan', function (Blueprint $table) {
            //
            $table->dropColumn('bukti_pembayaran');
            $table->dropColumn('tgl_investasi');
            $table->dropColumn('tgl_batas_pembayaran');
            $table->dropColumn('tgl_verifikasi');
        });
    }
}

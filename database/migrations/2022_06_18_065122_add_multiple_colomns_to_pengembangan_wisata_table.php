<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColomnsToPengembanganWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengembangan_wisata', function (Blueprint $table) {
            //
            $table->text('deskripsi')->after('target_dana');
            $table->string('imbal_hasil')->after('deskripsi');
            $table->bigInteger('min_investasi')->after('imbal_hasil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengembangan_wisata', function (Blueprint $table) {
            //
            $table->dropColumn('deskripsi');
            $table->dropColumn('imbal_hasil');
            $table->dropColumn('min_investasi');
        });
    }
}

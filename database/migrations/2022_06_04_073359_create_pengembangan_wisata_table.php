<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembanganWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembangan_wisata', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_wisata')->unsigned();
            $table->bigInteger('target_dana');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_wisata')->references('id')->on('wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembangan_wisata');
    }
}

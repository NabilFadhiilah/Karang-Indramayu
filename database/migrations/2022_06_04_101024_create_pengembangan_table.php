<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembangan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pengembangan')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_rekening')->unsigned();
            $table->bigInteger('pendanaan');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_pengembangan')->references('id')->on('pengembangan_wisata');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_rekening')->references('id')->on('rekening');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembangan');
    }
}

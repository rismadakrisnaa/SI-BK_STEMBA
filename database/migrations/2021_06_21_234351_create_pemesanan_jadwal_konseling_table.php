<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananJadwalKonselingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_jadwal_konseling', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('jadwal');
            $table->string('pukul');
            $table->string('perihal_bimbingan');
            $table->string('link');
            $table->boolean('is_active');
            $table->unsignedBigInteger('guru_bk_id');
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
        Schema::dropIfExists('pemesanan_jadwal_konseling');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKelasIdToPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan_jadwal_konseling', function (Blueprint $table) {
            $table->text('hasil_konseling');
            $table->unsignedBigInteger('kelas_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan_jadwal_konseling', function (Blueprint $table) {
            $table->dropColumn('kelas_id');
            $table->dropColumn('hasil_konseling');
        });
    }
}

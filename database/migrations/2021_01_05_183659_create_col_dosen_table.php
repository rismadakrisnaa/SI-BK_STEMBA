<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_dosen', function (Blueprint $col) {
            $col->string('dsn_nip');
            $col->string('dsn_nidn');
            $col->string('dsn_nama');
            $col->string('dsn_gelar_depan');
            $col->string('dsn_gelar_belakang');
            $col->string('dsn_kd_prodi');
            $col->string('dsn_nama_prodi');
            $col->string('dsn_kd_fakultas');
            $col->string('dsn_nama_fakultas');
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('col_dosen');
    }
}

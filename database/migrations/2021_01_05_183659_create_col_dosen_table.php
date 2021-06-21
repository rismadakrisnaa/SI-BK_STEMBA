<?php

/**
 * Copyright Gosoftware Media 2021
 * --
 * Gosoftware Media
 * Site   : http://gosoftware.web.id
 * e-mail : cs@gosoftware.web.id
 * WA     : 62852-6361-6901
 * --
 */

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

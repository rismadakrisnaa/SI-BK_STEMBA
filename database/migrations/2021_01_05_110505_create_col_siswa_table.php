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

class CreateColSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_siswa', function (Blueprint $col) {
            $col->string('siswa_nim');
            $col->string('siswa_nama');
            $col->string('siswa_jk');
            $col->string('siswa_tmplahir');
            $col->string('siswa_tgllahir');
            $col->string('siswa_alamat');
            $col->string('siswa_hp');
            $col->string('siswa_kd_kelasjurusan');
            $col->string('siswa_nama_kelasjurusan');
            $col->string('siswa_nidn_guru');
            $col->string('siswa_nama_guru');
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
        Schema::dropIfExists('col_siswa');
    }
}

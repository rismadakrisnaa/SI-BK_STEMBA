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

class CreateColMhswTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_mhsw', function (Blueprint $col) {
            $col->string('mhsw_nim');
            $col->string('mhsw_nama');
            $col->string('mhsw_jk');
            $col->string('mhsw_tmplahir');
            $col->string('mhsw_tgllahir');
            $col->string('mhsw_alamat');
            $col->string('mhsw_hp');
            $col->string('mhsw_kd_prodi');
            $col->string('mhsw_nama_prodi');
            $col->string('mhsw_nidn_dosen');
            $col->string('mhsw_nama_dosen');
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
        Schema::dropIfExists('col_mhsw');
    }
}

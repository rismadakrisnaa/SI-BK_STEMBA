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

class CreateColKelasjurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_kelasjurusan', function (Blueprint $col) {
            $col->string('kelasjurusan_kd_jenispelanggaran');
            $col->string('kelasjurusan_nama_jenispelanggaran');
            $col->string('kelasjurusan_kode');
            $col->string('kelasjurusan_nama');
            $col->string('kelasjurusan_akreditasi');
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
        Schema::dropIfExists('col_kelasjurusan');
    }
}

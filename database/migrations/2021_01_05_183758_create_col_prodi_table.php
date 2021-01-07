<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColProdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_prodi', function (Blueprint $col) {
            $col->string('prodi_kd_fak');
            $col->string('prodi_nama_fak');
            $col->string('prodi_kode');
            $col->string('prodi_nama');
            $col->string('prodi_akreditasi');
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
        Schema::dropIfExists('col_prodi');
    }
}

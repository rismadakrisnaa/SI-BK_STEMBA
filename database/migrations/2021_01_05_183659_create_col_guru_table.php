<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_guru', function (Blueprint $col) {
            $col->string('guru_nip');
            $col->string('guru_nidn');
            $col->string('guru_nama');
            $col->string('guru_gelar_depan');
            $col->string('guru_gelar_belakang');
            $col->string('guru_kd_kelasjurusan');
            $col->string('guru_nama_kelasjurusan');
            $col->string('guru_kd_riwayatpelanggaran');
            $col->string('guru_nama_riwayatpelanggaran');
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
        Schema::dropIfExists('col_guru');
    }
}

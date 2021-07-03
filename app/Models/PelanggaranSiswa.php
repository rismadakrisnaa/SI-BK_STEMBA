<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PelanggaranSiswa extends Model
{
    use HasFactory;

    protected $collection = 'pelanggaran_siswa';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    protected $guarded = [];

    public function pelanggaran()
    {
        return $this->belongsTo(Jenispelanggaran::class, "pelanggaran_id",'_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id','_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PemesananJadwalKonseling extends Model
{
    use HasFactory;

    protected $collection = 'pemesanan_jadwal_konseling';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    protected $guarded = [];

    public function guruBk()
    {
        return $this->belongsTo(GuruBk::class, 'guru_bk_id','_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id','_id');
    }

    public function classes()
    {
        return $this->belongsTo(Kelasjurusan::class, 'kelas_id','_id');
    }


}

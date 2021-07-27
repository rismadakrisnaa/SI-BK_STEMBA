<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Kelasjurusan extends Model
{
    use HasFactory;

    protected $collection = 'kelasjurusan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = '_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'kelasjurusan_kode';
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'guru_id', '_id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id','_id');
    }

    public function jadwaKonseling()
    {
        return $this->hasMany(PemesananJadwalKonseling::class, 'kelas_id','_id');
    }
}

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

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $collection = 'col_siswa';

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

    public function absen()
    {
        return $this->hasMany(Absensi::class, 'siswa_id','_id');
    }

    public function jadwalKonseling()
    {
        return $this->hasMany(PemesananJadwalKonseling::class, 'siswa_id','_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelasjurusan::class, 'kelasjurusan.kelasjurusan_kode' ,'kelasjurusan_kode');
    }

    public function timelineAkademik()
    {
        return $this->hasMany(TimelineAkademik::class, 'user_id','_id');
    }
}

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

    protected $collection = 'siswa';

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

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
        return $this->belongsTo(Kelasjurusan::class, 'kelas_id' ,'_id');
    }

    public function waliKelas()
    {
        $guru_id = $this->kelas->guru_id;
        return Guru::find($guru_id);
    }

    public function timelineAkademik()
    {
        return $this->hasMany(TimelineAkademik::class, 'user_id','_id');
    }

    public function pelanggaran()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'siswa_id', '_id');
    }

    public function homeVisit()
    {
        return $this->hasMany(HomeVisit::class, 'siswa_id', '_id');
    }

    public function panggilanOrtu()
    {
        return $this->hasMany(PanggilanOrtu::class, 'siswa_id', '_id');
    }

    public function totalPoint()
    {
        $point = $this->pelanggaran->sum('point');
        if($point<=74){
            $string = '<b class="text-success">'.$point.'</b>';
        }elseif($point<=89){
            $string = '<b class="text-warning">'.$point.'</b>';
        }else{
            $string = '<b class="text-danger">'.$point.'</b>';
        }
        return $string;
    }
}

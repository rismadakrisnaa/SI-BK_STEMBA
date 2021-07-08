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

class Guru extends Model
{
    use HasFactory;

    protected $collection = 'guru';

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

    public function kelas()
    {
        return $this->hasMany(Kelasjurusan::class, 'guru_id', '_id');
    }

    public function siswa()
    {
        $siswa_ids = $this->kelas()->select('kelas._id')->get()->pluck('_id');
        return Siswa::whereIn('kelas_id',$siswa_ids)->get();
    }

    public function getFullName()
    {
        $gelarDepan    = !empty($this->guru_gelar_depan) ? $this->guru_gelar_depan . '. ' : '';
        $gelarBelakang = !empty($this->guru_gelar_belakang) ? ', ' . $this->guru_gelar_belakang : '';
        return $gelarDepan.$this->guru_nama.$gelarBelakang;
    }
}

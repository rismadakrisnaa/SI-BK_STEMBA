<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class GuruBk extends Model
{
    use HasFactory;

    protected $collection = 'guru_bk';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    protected $guarded = [];

    public function pemesananJadwalKonseling()
    {
        return $this->hasMany(PemesananJadwalKonseling::class, 'guru_bk_id','_id');
    }

    public function panggilanOrtu()
    {
        return $this->hasMany(PanggilanOrtu::class, 'gurubk_id', '_id');
    }
}

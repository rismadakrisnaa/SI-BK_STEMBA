<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PanggilanOrtu extends Model
{
    use HasFactory;

    protected $collection = 'panggilan_ortu';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id','_id');
    }

    public function guruBk()
    {
        return $this->belongsTo(GuruBk::class, 'gurubk_id','_id');
    }
}

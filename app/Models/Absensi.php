<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $collection = 'absensi';

    protected $primaryKey = '_id';


    protected $keyType = 'string';

    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id','_id');
    }
}

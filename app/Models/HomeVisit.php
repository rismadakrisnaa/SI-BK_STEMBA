<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class HomeVisit extends Model
{
    use HasFactory;

    protected $collection = 'home_visit';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    protected $guarded = [];

    public function pelanggaran()
    {
        return $this->belongsTo(Jenispelanggaran::class, "jenispelanggaran_id",'_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id','_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $collection = 'orang_tua';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','_id','cascade');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'orang_tua_id', '_id');
    }
}

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
}

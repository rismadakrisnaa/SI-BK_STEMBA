<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TimelineAkademik extends Model
{
    use HasFactory;

    protected $collection = 'timeline_akademik';

    protected $primaryKey = '_id';

    protected $keyType = 'string';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','_id');
    }
}

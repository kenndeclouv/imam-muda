<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedSchedule extends Model
{
    protected $guarded = [];

    public function Imam()
    {
        return $this->belongsTo(Imam::class);
    }
    public function Shalat()
    {
        return $this->belongsTo(Shalat::class);
    }
    public function Masjid()
    {
        return $this->belongsTo(Masjid::class);
    }
}

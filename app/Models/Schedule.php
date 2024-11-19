<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

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
    public function Badal()
    {
        return $this->belongsTo(Imam::class, 'badal_id');
    }
}

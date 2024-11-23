<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['Shalat', 'Masjid', 'Badal'];
    
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
    public function scopeFilterByImam($query, $imamId)
    {
        return $query->when($imamId, fn($q) => $q->where('imam_id', $imamId));
    }

    public function scopeFilterByShalat($query, $shalatId)
    {
        return $query->when($shalatId, fn($q) => $q->where('shalat_id', $shalatId));
    }

    public function scopeFilterByMasjid($query, $masjidId)
    {
        return $query->when($masjidId, fn($q) => $q->where('masjid_id', $masjidId));
    }
}

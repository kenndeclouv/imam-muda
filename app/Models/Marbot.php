<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marbot extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Imam()
    {
        return $this->belongsTo(Imam::class);
    }
    public function Masjid()
    {
        return $this->belongsTo(Masjid::class);
    }
}

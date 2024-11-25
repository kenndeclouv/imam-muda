<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function ListFee()
    {
        return $this->hasOne(ListFee::class);
    }
}

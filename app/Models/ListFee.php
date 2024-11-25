<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListFee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Imam()
    {
        return $this->belongsTo(Imam::class, 'imam_id');
    }
    public function Masjid()
    {
        return $this->belongsTo(Masjid::class, 'masjid_id');
    }
    public function Fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
    public function Shalat()
    {
        return $this->belongsTo(Shalat::class, 'shalat_id');
    }
}

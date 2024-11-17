<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Schedules()
    {
        return $this->hasMany(Schedule::class, 'imam_id');
    }
    public function Fee()
    {
        return $this->hasOne(Fee::class);
    }
    public function getPhotoAttribute($value)
    {
        return (!empty($value) && !is_null($value)) ? asset('/storage/' . $value) : $value;
    }
}

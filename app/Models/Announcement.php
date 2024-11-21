<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function Target()
    {
        return $this->belongsTo(Role::class, 'target_id');
    }
    public function getPhotoAttribute($value)
    {
        return (!empty($value) && !is_null($value)) ? asset($value) : null;
    }
}

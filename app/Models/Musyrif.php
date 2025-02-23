<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Musyrif extends Model
{
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}

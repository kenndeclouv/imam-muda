<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Memorizations()
    {
        return $this->hasMany(StudentMemorization::class);
    }

    public function Permits()
    {
        return $this->hasMany(StudentPermit::class);
    }
}

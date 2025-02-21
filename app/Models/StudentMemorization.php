<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMemorization extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }

    public function Imam()
    {
        return $this->belongsTo(Imam::class);
    }
}

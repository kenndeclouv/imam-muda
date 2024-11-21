<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HadithMuslim extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'arab', 'ind'];
}

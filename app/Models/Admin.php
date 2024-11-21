<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }
    public function getPermissionCodes()
    {
        // pastikan permission ada dan ambil feature codes
        return $this->Permissions
            ? $this->Permissions->pluck('Feature.code')
            : collect([]);
    }
}

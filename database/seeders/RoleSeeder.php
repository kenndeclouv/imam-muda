<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'code' => 'superadmin',
            'name' => 'Super Admin',
        ]);
        Role::create([
            'code' => 'admin',
            'name' => 'Admin',
        ]);
        Role::create([
            'code' => 'imam',
            'name' => 'Imam',
        ]);
    }
}

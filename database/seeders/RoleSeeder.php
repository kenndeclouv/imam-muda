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
        $roles = [
            ['code' => 'superadmin', 'name' => 'Super Admin'],
            ['code' => 'admin', 'name' => 'Admin'],
            ['code' => 'imam', 'name' => 'Imam'],
            ['code' => 'student', 'name' => 'Student']
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}

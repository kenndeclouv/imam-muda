<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Feature;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kenn',
            'email' => 'kenndeclouv@gmail.com',
            'username' => 'superadmin',
            'password' => 'superadmin',
            'email_verified_at' => now(),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Ustadz Rujian',
            'email' => 'rujian@gmail.com',
            'username' => 'rujian',
            'password' => 'rujian',
            'email_verified_at' => now(),
            'role_id' => 2,
        ]);

        Admin::create([
            'user_id' => 2,
            'fullname' => 'Ustadz Rujian',
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'birthdate' => fake()->date(),
            'birthplace' => fake()->city(),
            'description' => fake()->realText(20),
        ]);

        Permission::create([
            'user_id' => 2,
            'feature_id' => 1
        ]);
    }
}

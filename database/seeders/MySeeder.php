<?php

namespace Database\Seeders;

use App\Models\Imam;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class MySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'code' => 'admin',
            'name' => 'Admin',
        ]);
        Role::create([
            'code' => 'super_admin',
            'name' => 'Super Admin',
        ]);
        Role::create([
            'code' => 'imam',
            'name' => 'Imam',
        ]);

        User::create([
            'name' => 'Ustadz Alfin Shahih',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => 'admin',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Ustadz Rujian',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'password' => 'admin',
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Haidar',
            'email' => 'imam@gmail.com',
            'username' => 'haidar',
            'password' => 'haidar',
            'role_id' => 3,
        ]);

        Imam::create([
            'user_id' => 3,
            'fullname' => 'Imam 1',
            'phone' => fake()->phoneNumber,
            'birthplace' => fake()->city(),
            'birthdate' => fake()->date(),
            'juz' => rand(1,30),
            'address' => fake()->address,
            'description' => fake()->text(20),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => fake()->name,
                'email' => fake()->email,
                'username' => fake()->userName,
                'password' => 'password',
                'role_id' => 3,
            ]);
            Imam::create([
                'user_id' => $user->id,
                'fullname' => fake()->name,
                'phone' => fake()->phoneNumber,
                'birthplace' => fake()->city(),
                'birthdate' => fake()->date(),
                'juz' => rand(1, 30),
                'address' => fake()->address,
                'description' => fake()->text(20),
            ]);
        }
    }
}

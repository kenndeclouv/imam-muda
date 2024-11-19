<?php

namespace Database\Seeders;

use App\Models\Fee;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Role;
use App\Models\Shalat;
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
            'code' => 'super_admin',
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

        User::create([
            'name' => 'Ustadz Alfin Shahih',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => 'admin',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Ustadz Rujian',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'password' => 'admin',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Imam',
            'email' => 'imam@gmail.com',
            'username' => 'imam',
            'password' => 'imam',
            'role_id' => 3,
        ]);

        Imam::create([
            'user_id' => 3,
            'fullname' => 'Imam 1',
            'phone' => fake()->phoneNumber,
            'birthplace' => fake()->city(),
            'birthdate' => fake()->date(),
            'juz' => rand(1, 30),
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
            $imam = Imam::create([
                'user_id' => $user->id,
                'fullname' => fake()->name,
                'phone' => fake()->phoneNumber,
                'birthplace' => fake()->city(),
                'birthdate' => fake()->date(),
                'juz' => rand(1, 30),
                'address' => fake()->address,
                'description' => fake()->text(20),
            ]);

            Fee::create([
                'imam_id' => $imam->id,
                'fee' => rand(1000, 10000),
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            Masjid::create([
                'name' => 'Masjid ' . $i,
                'address' => fake()->address,
            ]);
        }

        Shalat::create([
            'name' => 'Subuh',
            'start' => '04:00:00',
            'end' => '05:00:00',
        ]);
        Shalat::create([
            'name' => 'Dzuhur',
            'start' => '12:00:00',
            'end' => '13:00:00',
        ]);
        Shalat::create([
            'name' => 'Ashar',
            'start' => '15:00:00',
            'end' => '16:00:00',
        ]);
    }
}

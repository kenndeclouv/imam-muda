<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 3; $i++) {
            $user = \App\Models\User::firstOrCreate([
                'username' => 'student' . $i,
            ], [
                'name' => 'Student ' . $i,
                'email' => 'student' . $i . '@example.com',
                'role_id' => 4,
                'password' => 'password',
            ]);

            \App\Models\Student::firstOrCreate([
                'user_id' => $user->id,
            ], [
                'fullname' => 'Student ' . $i,
                'birthplace' => fake()->city(),
                'birthdate' => fake()->date(),
                'address' => fake()->address(),
                'school' => fake()->word(),
                'father_name' => fake()->name(),
                'father_job' => fake()->word(),
                'mother_name' => fake()->name(),
                'mother_job' => fake()->word(),
                'motivation' => fake()->sentence(),
                'class_time' => fake()->randomElement(['morning', 'evening']),
                'residence_status' => fake()->randomElement(['mukim', 'non_mukim']),
                'infaq' => rand(100000, 1000000),
                'whatsapp' => fake()->phoneNumber(),
                'youtube_link' => fake()->url(),
                'is_active' => fake()->boolean(),
            ]);
        }
        for ($i = 0; $i < 3; $i++) {
            $user = \App\Models\User::firstOrCreate([
                'username' => 'musyrif' . $i,
            ], [
                'name' => 'Musyrif ' . $i,
                'email' => 'musyrif' . $i . '@example.com',
                'role_id' => 5,
                'password' => 'password',
            ]);

            \App\Models\Musyrif::firstOrCreate([
                'user_id' => $user->id,
            ], [
                'fullname' => 'Musyrif ' . $i,
                'birthplace' => fake()->city(),
                'birthdate' => fake()->date(),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'description' => fake()->sentence(),
            ]);
        }
    }
}

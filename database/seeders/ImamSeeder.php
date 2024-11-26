<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Imam;
use App\Models\Fee;
use App\Models\ListFee;

class ImamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imamSenior = [
            [
                'name' => 'Muhammad Abduh Mustofa',
                'username' => 'abduh',
            ],
            [
                'name' => 'Andri Ferdi. A. Y.',
                'username' => 'andri',
            ],
            [
                'name' => 'Suryadi',
                'username' => 'suryadi',
            ],
            [
                'name' => 'Abdurrozzaaq Ashshiddiqi Zuhri',
                'username' => 'abdurrozzaaq',
            ],
            [
                'name' => 'Wahyudi Setiawan',
                'username' => 'wahyudi',
            ],
            [
                'name' => 'Yusufa ichlasul amal',
                'username' => 'yusufa',
            ],
            [
                'name' => 'Hanief Febry Ferdiansyah',
                'username' => 'hanief',
            ],
            [
                'name' => 'Mohammad Said',
                'username' => 'mohammad',
            ]
        ];

        $imamJunior = [
            [
                'name' => 'Abu Bakar',
                'username' => 'abu',
            ],
            [
                'name' => 'Fayyad Jidan',
                'username' => 'fayyad',
            ],
            [
                'name' => 'Muhammad Rafi Akbar',
                'username' => 'rafi',
            ],
            [
                'name' => 'Mukhamad Ilyas Ansari',
                'username' => 'ilyas',
            ],
            [
                'name' => 'Rajabul Fahrudin',
                'username' => 'rajabul',
            ],
            [
                'name' => 'Ryohull Arbyanto',
                'username' => 'ryohull',
            ],
            [
                'name' => 'Rafif Naufal Surya Atta',
                'username' => 'rafif',
            ],
            [
                'name' => 'Iqbal Sabiq',
                'username' => 'iqbal',
            ],
            [
                'name' => 'Rizky Fajar Maulana',
                'username' => 'rizky',
            ],
            [
                'name' => 'Yunus Muhammad',
                'username' => 'yunus',
            ],
            [
                'name' => 'Afiful Islam',
                'username' => 'afiful',
            ],
            [
                'name' => 'Huda',
                'username' => 'huda',
            ],
            [
                'name' => 'Maulidi Thariq',
                'username' => 'maulidi',
            ],
            [
                'name' => 'M. Rafli Audremi',
                'username' => 'rafli',
            ],
        ];
        foreach ($imamSenior as $imam) {
            $user = User::create([
                'name' => $imam['name'],
                'email' => fake()->email,
                'username' => strtolower($imam['username']),
                'password' => 'password',
                'role_id' => 3,
            ]);
            $imam = Imam::create([
                'user_id' => $user->id,
                'fullname' => $imam['name'],
                'phone' => fake()->phoneNumber,
                'birthplace' => fake()->city(),
                'birthdate' => fake()->date(),
                'juz' => rand(1, 30),
                'address' => fake()->address,
                'description' => fake()->text(20),
                'join_date' => fake()->date(),
                'no_rekening' => fake()->bankAccountNumber,
                'status' => fake()->randomElement(['nikah', 'belum nikah']),
                'child_count' => rand(0, 5),
                'wife_count' => rand(0, 3),
            ]);

            ListFee::create([
                'imam_id' => $imam->id,
                'fee_id' => 1,
            ]);
        }
        foreach ($imamJunior as $imam) {
            $user = User::create([
                'name' => $imam['name'],
                'email' => fake()->email,
                'username' => strtolower($imam['username']),
                'password' => 'password',
                'role_id' => 3,
            ]);
            $imam = Imam::create([
                'user_id' => $user->id,
                'fullname' => $imam['name'],
                'phone' => fake()->phoneNumber,
                'birthplace' => fake()->city(),
                'birthdate' => fake()->date(),
                'juz' => rand(1, 30),
                'address' => fake()->address,
                'description' => fake()->text(20),
                'join_date' => fake()->date(),
                'no_rekening' => fake()->bankAccountNumber,
                'status' => fake()->randomElement(['nikah', 'belum nikah']),
                'child_count' => rand(0, 5),
                'wife_count' => rand(0, 3),
            ]);

            ListFee::create([
                'imam_id' => $imam->id,
                'fee_id' => 2,
            ]);
        }
    }
}

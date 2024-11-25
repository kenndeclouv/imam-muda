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
                'fee' => 1,
            ],
            [
                'name' => 'Andri Ferdi. A. Y.',
                'username' => 'andri',
                'fee' => 1,
            ],
            [
                'name' => 'Suryadi',
                'username' => 'suryadi',
                'fee' => 1,
            ],
            [
                'name' => 'Abdurrozzaaq Ashshiddiqi Zuhri',
                'username' => 'abdurrozzaaq',
                'fee' => 1,
            ],
            [
                'name' => 'Wahyudi Setiawan',
                'username' => 'wahyudi',
                'fee' => 1,
            ],
            [
                'name' => 'Yusufa ichlasul amal',
                'username' => 'yusufa',
                'fee' => 1,
            ],
            [
                'name' => 'Hanief Febry Ferdiansyah',
                'username' => 'hanief',
                'fee' => 1,
            ],
            [
                'name' => 'Mohammad Said',
                'username' => 'mohammad',
                'fee' => 1,
            ]
        ];

        $imamJunior = [
            [
                'name' => 'Abu Bakar',
                'username' => 'abu',
                'fee' => 2,
            ],
            [
                'name' => 'Fayyad Jidan',
                'username' => 'fayyad',
                'fee' => 2,
            ],
            [
                'name' => 'Muhammad Rafi Akbar',
                'username' => 'rafi',
                'fee' => 2,
            ],
            [
                'name' => 'Mukhamad Ilyas Ansari',
                'username' => 'ilyas',
                'fee' => 2,
            ],
            [
                'name' => 'Rajabul Fahrudin',
                'username' => 'rajabul',
                'fee' => 2,
            ],
            [
                'name' => 'Ryohull Arbyanto',
                'username' => 'ryohull',
                'fee' => 2,
            ],
            [
                'name' => 'Rafif Naufal Surya Atta',
                'username' => 'rafif',
                'fee' => 2,
            ],
            [
                'name' => 'Iqbal Sabiq',
                'username' => 'iqbal',
                'fee' => 2,
            ],
            [
                'name' => 'Rizky Fajar Maulana',
                'username' => 'rizky',
                'fee' => 2,
            ],
            [
                'name' => 'Yunus Muhammad',
                'username' => 'yunus',
                'fee' => 2,
            ],
            [
                'name' => 'Afiful Islam',
                'username' => 'afiful',
                'fee' => 2,
            ],
            [
                'name' => 'Huda',
                'username' => 'huda',
                'fee' => 2,
            ],
            [
                'name' => 'Maulidi Thariq',
                'username' => 'maulidi',
                'fee' => 2,
            ],
            [
                'name' => 'M. Rafli Audremi',
                'username' => 'rafli',
                'fee' => 2,
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
            ]);

            ListFee::create([
                'imam_id' => $imam->id,
                'fee_id' => 2,
            ]);
        }
    }
}

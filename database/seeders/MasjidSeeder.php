<?php

namespace Database\Seeders;

use App\Models\Masjid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasjidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masjids = [
            [
                'name' => 'Abdullah',
            ],
            [
                'name' => 'Mujahidin',
            ],
            [
                'name' => 'Darusalam',
            ],
            [
                'name' => 'Ar Raudhah',
            ],
            [
                'name' => 'An Nur BMW',
            ],
            [
                'name' => 'Al Muslimun',
            ],
            [
                'name' => 'Babusalam',
            ],
            [
                'name' => 'Sabilisalam',
            ],
            [
                'name' => 'Darussolih',
            ],
            [
                'name' => 'Syuhada Karang Lo',
            ],
            [
                'name' => 'Al Mukminun Mahakam',
            ],
        ];
        foreach ($masjids as $masjid) {
            Masjid::create([
                'name' => $masjid['name'],
                'address' => fake()->address,
                
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Shalat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShalatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shalats = [
            ['name' => 'Subuh', 'start' => '04:00:00', 'end' => '05:00:00'],
            ['name' => 'Maghrib - Isya', 'start' => '18:00:00', 'end' => '20:00:00'],
            ['name' => 'Maghrib', 'start' => '18:00:00', 'end' => '19:00:00'],
            ['name' => 'Isya', 'start' => '19:00:00', 'end' => '20:00:00'],
        ];
        foreach ($shalats as $shalat) {
            Shalat::create([
                'name' => $shalat['name'],
                'start' => $shalat['start'],
                'end' => $shalat['end'],
            ]);
        }
    }
}

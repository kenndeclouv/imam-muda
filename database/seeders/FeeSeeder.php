<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fee::create([
            'name' => 'Grade A',
            'type' => 'imam',
            'amount' => 30000,
        ]);
        Fee::create([
            'name' => 'Grade B',
            'type' => 'imam',
            'amount' => 35000,
        ]);
    }
}
